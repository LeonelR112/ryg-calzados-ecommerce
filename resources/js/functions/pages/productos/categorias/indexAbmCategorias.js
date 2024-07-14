let input_search = document.getElementById('input_search');
let tbody_categorias = document.getElementById('tbody_categorias');
let form_del_categ = document.getElementById('form_del_categ');
let input_del_id_categ = document.getElementById('input_del_id_categ');
let Controller = null

class TablaCategoriaController extends FrontTools{
    constructor(){
        super();
    }

    renderCategorias(array_categorias){
        if(array_categorias.length == 0){
            $("#paginador").html("");
            tbody_categorias.innerHTML = `
                <tr>
                    <td class="text-muted" colspan="6">No se encontraron categorias...</td>
                </tr>
            `;
        }
        else if(array_categorias.length <= 20){
            $("#paginador").html("");
            tbody_categorias.innerHTML = ``;
            let output = this.obtenerFilasDeLaTabla(array_categorias);
            $(tbody_categorias).append(output);
        }
        else{
            $('#paginador').pagination({
                dataSource: array_categorias,
                pageSize: 20,
                callback: function(data, pagination) {
                    tbody_categorias.innerHTML = ``;
                    let output = this.obtenerFilasDeLaTabla(data);
                    $(tbody_categorias).append(output);
                }
            })
        }
    }

    obtenerFilasDeLaTabla(array_categorias){
        let output_html = '';
        for(let categoria of array_categorias){
            output_html += `
                <tr id="tr_${categoria.id_categ}">
                    <td>${categoria.id_categ}</td>
                    <td class="text-center">
                        ${categoria.imagen != '' ? `<a href="${categoria.imagen}" data-lightbox="image-${categoria.id_categ}" data-title="Imagen de la categoria"><img src="${categoria.imagen}" alt="img_not_found" class="rounded shadow-sm img-card-table" /></a>` : "-"}
                    </td>
                    <td>${categoria.nombrecat}</td>
                    <td class="text-center">${categoria.visible == "S" ? `<span class="badge bg-success">Visible</span>` : `<span class="badge bg-secondary">No visible</span>`}</td>
                    <td class="text-center"><i class="bi bi-square-fill border fs-3" style="color:${categoria.color}"></i></td>
                    <td class="text-end">
                        <a href="${route('auth/productos/categorias/modificar/' + categoria.id_categ)}" title="Editar" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <button class="btn btn-danger btn-sm" type="button" id="btn_del_${categoria.id_categ}" onclick="Controller.eliminarCategoria('${categoria.id_categ}')" title="Eliminar"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            `;
        }
        return output_html;
    }

    filtrarCategorias(valor){
        let valor_buscar = valor.toLowerCase();
        if(valor_buscar.length == 0){
            this.renderCategorias(JSON_CATEGORIAS);
        }
        else{
            let valores_filtrados = [];
            for(let categoria of JSON_CATEGORIAS){
                let nombrecat = categoria.nombrecat.toLowerCase();
                if(nombrecat.includes(valor_buscar)) valores_filtrados.push(categoria);
            }
            this.renderCategorias(valores_filtrados);
        }
    }

    eliminarCategoria(id_categ){
        let categoria = JSON_CATEGORIAS.find( element => element.id_categ == id_categ);
        if(!categoria) throw new Error("No se ha encontrado una categoría con id " + id_categ);
        Swal.fire({
            title: "Borrar categoría",
            html: `Está a punto de eliminar la categoría <b>${categoria.nombrecat}</b>. Si ya tiene asignado productos a esta categoría, también serán borrados en sus vinculaciones, por ende los productos no se mostrarán en las vistas públicas <br>¿Confirmar borrado?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Si, borrar",
            cancelButtonText : "Cancelar"
        }).then((result) => {
            if(result.isConfirmed) {
                let tr = document.getElementById(`tr_${id_categ}`);
                let btn_del = document.getElementById(`btn_del_${id_categ}`);
                tr.classList.add('text-decoration-line-through');
                btn_del.setAttribute('disabled', '');
                btn_del.innerHTML = this.getSpinnerSMTemplate();
                input_del_id_categ.value = categoria.id_categ;
                form_del_categ.submit();
            }
        });
    }
}

input_search.addEventListener('keyup', e => Controller.filtrarCategorias(e.target.value));
document.addEventListener('DOMContentLoaded', e => {
    Controller = new TablaCategoriaController();
    Controller.renderCategorias(JSON_CATEGORIAS);
})