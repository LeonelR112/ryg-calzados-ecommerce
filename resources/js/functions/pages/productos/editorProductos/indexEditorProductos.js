let Controller = null;
let tbody_productos = document.getElementById('tbody_productos');
let input_search = document.getElementById('input_search');

class IndexProductosEditorHandler extends FrontTools{
    constructor(){
        super();
        this.KEY_FILTER = 'fil-editorProd-adm';
        this.KEY_LASTPAG = 'lastpag-editorProd-adm';
    }

    renderTablaDeProductos(array_productos){
        if(array_productos.length == 0){
            $("#paginador").html("");
            tbody_productos.innerHTML = `
                <tr>
                    <td class="text-muted" colspan="9">No se encontraron productos...</td>
                </tr>
            `;
        }
        else if(array_productos.length <= 20){
            $("#paginador").html("");
            tbody_productos.innerHTML = ``;
            let output = this.obtenerFilasDeTablaProductos(array_productos);
            $(tbody_productos).append(output);
        }
        else{
            $('#paginador').pagination({
                dataSource: array_productos,
                pageSize: 20,
                callback: function(data, pagination) {
                    tbody_productos.innerHTML = ``;
                    let output = this.obtenerFilasDeTablaProductos(data);
                    $(tbody_productos).append(output);
                }
            })
        }
    }

    obtenerFilasDeTablaProductos(array_productos){
        let output_html = '';
        for(let producto of array_productos){
            output_html += `
                <tr> 
                    <td>${producto.id_producto}</td>
                    <td>${producto.nro_art}</td>
                    <td class="text-center"><a href="${producto.imagen}" data-lightbox="image-${producto.id_producto}" data-title="Producto nro ${producto.id_producto}"><img src="${producto.imagen}" class="rounded shadow-sm img-card-table" alt="img_not_found" /></a></td>
                    <td>${producto.nombreprod}</td>
                    <td class="text-center">${producto.stock == 'S' ? '<span class="badge bg-success">En stock</span>' : '<span class="badge bg-danger">Sin stock</span>'}</td>
                    <td class="text-center">${producto.visible == 'S' ? '<i class="bi bi-circle-fill fs-5 text-success" title="Producto visible al público"></i>' : '<i class="bi bi-circle-fill fs-5 text-dark" title="Producto no visible al público"></i>'}</td>
                    <td class="text-center">$ ${Number(producto.precio).toLocaleString('es-AR')}</td>
                    <td class="text-center">$ ${Number(producto.precio_unitario).toLocaleString('es-AR')}</td>
                    <td class="text-end">
                        <a class="btn btn-info btn-sm" href="#" title="Ver más detalles"><i class="bi bi-list-task"></i></a>
                        <a class="btn btn-primary btn-sm" href="${route('auth/productos/editor-producto/modificar/' + producto.id_producto)}" title="Editar producto"><i class="bi bi-pencil-square"></i></a>
                        <button class="btn btn-danger btn-sm" type="button" title="Borrar producto"><i class="bi bi-trash3"></i></button>
                    </td>
                </tr>
            `;
        }
        return output_html;
    }

    filtrarTablaDeProductos(valor){
        let valor_buscar = valor.toLowerCase();
        if(valor_buscar.length == 0){
            this.renderTablaDeProductos(JSON_PRODUCTOS);
            this.removeStorage(this.KEY_FILTER);
        }
        else{
            let valores_filtrados = [];
            for(let producto of JSON_PRODUCTOS){
                let nombreprod = producto.nombreprod.toLowerCase();
                if(nombreprod.includes(valor_buscar)) valores_filtrados.push(producto);
            }
            this.setStorage(this.KEY_FILTER, `${valor}`);
            this.renderTablaDeProductos(valores_filtrados);
        }
    }
}

input_search.addEventListener('keyup', e => Controller.filtrarTablaDeProductos(e.target.value));
document.addEventListener('DOMContentLoaded', e => {
    Controller = new IndexProductosEditorHandler();
    Controller.renderTablaDeProductos(JSON_PRODUCTOS);
    let ult_filtro = Controller.getStorage(Controller.KEY_FILTER);
    if(ult_filtro){
        input_search.value = ult_filtro;
        input_search.focus();
        Controller.filtrarTablaDeProductos(ult_filtro);
    }
})
