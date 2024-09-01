let Controller = null;
let tbody_productos = document.getElementById('tbody_productos');
let input_search = document.getElementById('input_search');
let form_del_product = document.getElementById('form_del_product');
let input_del_id_producto = document.getElementById('input_del_id_producto');

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
                        <button class="btn btn-info btn-sm" title="Ver más detalles" onclick="Controller.verDetallesDelProducto('${producto.id_producto}')"><i class="bi bi-list-task"></i></button>
                        <a class="btn btn-primary btn-sm" href="${route('auth/productos/editor-producto/modificar/' + producto.id_producto)}" title="Editar producto"><i class="bi bi-pencil-square"></i></a>
                        <button class="btn btn-danger btn-sm" type="button" title="Borrar producto" id="btn_del_${producto.id_producto}" onclick="Controller.borrarProducto('${producto.id_producto}')"><i class="bi bi-trash3"></i></button>
                    </td>
                </tr>
            `;
        }
        return output_html;
    }

    verDetallesDelProducto(id_producto){
        let producto = JSON_PRODUCTOS.find( element => element.id_producto == id_producto);
        if(!producto) throw new Error("No se encontró un producto con id_producto = " + id_producto);
        let output_html = `
            <section class="row m-0 g-3">
                <div class="col-12 text-center">
                    <img src="${producto.imagen}" alt="img_not_found" class="img-card-table-md rounded shadow-sm" />
                    <h5 class="text-center">${producto.nombreprod}</h5>
                </div>
                <div class="col-12 col-lg-6">
                    <ul class="list-group list-group-flush text-start">
                        <li class="list-group-item"><span class="text-muted">ID:</span> ${producto.id_producto}</li>
                        <li class="list-group-item"><span class="text-muted">Nro de artículo:</span> ${producto.nro_art}</li>
                        <li class="list-group-item"><span class="text-muted">Orden:</span> ${producto.orden}</li>
                        <li class="list-group-item"><span class="text-muted">Visible:</span> ${producto.visible == 'S' ? '<span class="badge bg-success" title="Este producto se mostrará al público">Visible</span>' : '<span class="badge bg-secondary" title="Este producto no es visible al público">No visible</span>'}</li>
                    </ul>
                </div>
                <div class="col-12 col-lg-6">
                    <ul class="list-group list-group-flush text-start">
                        <li class="list-group-item"><span class="text-muted">Precio por mayor:</span> $ ${Number(producto.precio).toLocaleString('es-AR')}</li>
                        <li class="list-group-item"><span class="text-muted">Precio unitario:</span> $ ${Number(producto.precio_unitario).toLocaleString('es-AR')}</li>
                        <li class="list-group-item"><span class="text-muted">Stock:</span> ${producto.stock == 'S' ? '<span class="badge bg-success">En stock</span>' : '<span class="badge bg-danger">Sin stock</span>'}</li>
                        <li class="list-group-item"><span class="text-muted">Talles:</span> ${producto.talles}</li>
                    </ul>
                </div>
                <div class="col-12">
                    <p class="text-center fs-5 mb-0">Descripción resumida</p>
                    <hr>
                    <p>${producto.descri_c}</p>
                </div>
                <div class="col-12">
                    <p class="text-center fs-5 mb-0">Descripción completa</p>
                    <hr>
                    <p>${producto.descri_l}</p>
                </div>
            </section>
        `;
        Swal.fire({
            html : output_html,
            width : "55rem",
            confirmButtonText : "Cerrar"
        });
    }

    borrarProducto(id_producto){
        let producto = JSON_PRODUCTOS.find( element => element.id_producto == id_producto);
        if(!producto) throw new Error("No se encontró un producto con id_producto = " + id_producto);
        Swal.fire({
            title: "Borrar producto",
            html: `<p>Está a punto de eliminar el producto <b>${producto.nombreprod}</b>. ¿Confirmar borrado?</p>`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#161616", 
            confirmButtonText: "Si, borrar",
            cancelButtonText : "Cancelar",
            toast : true
        }).then((result) => {
            if(result.isConfirmed) {
                let btn_del = document.getElementById(`btn_del_${id_producto}`);
                btn_del.setAttribute('disabled', '');
                btn_del.innerHTML = `${this.getSpinnerSMTemplate()}`;
                input_del_id_producto.value = id_producto;
                form_del_product.submit();
            }
        });
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
