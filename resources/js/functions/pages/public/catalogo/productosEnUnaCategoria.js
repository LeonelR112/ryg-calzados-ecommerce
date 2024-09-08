let Controller = null;
let input_search = document.getElementById('input_search');
let content_products = document.getElementById('content_products');
let content_clear_filter = document.getElementById('content_clear_filter');

class HandlerProductosEnCategoria extends FrontTools{
    constructor(){
        super();
        this.KEY_FILTER = 'fil-procat-cataloge';
        this.KEY_LASTPAG = 'lastpag-procat';
    }

    renderListaDeProductos(array_productos){
        let self = this;
        if(array_productos.length == 0){
            $("#paginador").html("");
            content_products.innerHTML = `
                <tr>
                    <td class="text-muted" colspan="9">No se encontraron productos...</td>
                </tr>
            `;
            this.removeStorage(this.KEY_LASTPAG);
        }
        else if(array_productos.length <= 20){
            $("#paginador").html("");
            content_products.innerHTML = ``;
            let output = this.obtenerTarjetasDeProductos(array_productos);
            $(content_products).append(output);
            this.removeStorage(this.KEY_LASTPAG);
        }
        else{
            $('#paginador').pagination({
                dataSource: array_productos,
                pageSize: 20,
                callback: function(data, pagination) {
                    content_products.innerHTML = ``;
                    let output = self.obtenerTarjetasDeProductos(data);
                    $(content_products).append(output);
                    self.setStorage(self.KEY_LASTPAG, pagination.pageNumber);
                }
            })
        }
    }

    obtenerTarjetasDeProductos(array_productos){
        let output_html = '';
        let delay_time = 100;
        for(let producto of array_productos){
            output_html += `
                <article class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card position-relative flip-in-ver-left" style="animation-delay: ${delay_time}ms">
                        <div class="card-body">
                            <div class="d-flex justify-content-end align-items-center flex-column">
                                <a href="${producto.imagen}" data-lightbox="producto-${producto.id_producto}" data-title="${producto.nombreprod}"><img src="${producto.imagen}" alt="img-not-found" class="rounded shadow-sm img-fluid" /></a>
                                <div class="w-100 fs-3 fw-bold text-center text-wrap">${producto.nombreprod}</div>
                                <div class="w-100 small text-center text-wrap">${producto.descri_c}</div>
                                <div class="w-100 text-center small fw-bold text-wrap">Talles disponibles: <br> ${this.obtenerLabelDeTalles(producto.talles)}</div>
                                <div class="w-100 text-center text-price-product">$ ${Number(producto.precio).toLocaleString('es-AR')}</div>
                                <div class="w-100 text-center small">Precio mayorista</div>
                                <div class="w-100 text-center small text-muted"><i class="bi bi-hand-index"></i> Más detalles</div>
                            </div>
                        </div>
                        <a href="#" class="stretched-link"></a>
                    </div>
                </article>
            `;
            delay_time = delay_time + 150;
        }
        return output_html;
    }

    obtenerLabelDeTalles(string_talles){
        let talles_label = '';
        let talles_explodded = string_talles.split(",");
        for(let talle of talles_explodded){
            talles_label += `${talle == 'es' ? ` <span class="badge bg-primary">Especial</span>` : ` <span class="badge text-bg-primary">${talle}</span>`}`;
        }
        return talles_label
    }

    filtrarProductoDelCatalogo(valor){
        let valor_buscar = valor.toLowerCase();
        if(valor_buscar.length == 0){
            this.renderListaDeProductos(JSON_PRODUCTOS);
            content_clear_filter.innerHTML = '';
            this.removeStorage(this.KEY_FILTER);
        }
        else{
            let valores_encontrados = [];
            for(let producto of JSON_PRODUCTOS){
                let nombreprod = producto.nombreprod.toLowerCase();
                let descri_c = producto.descri_c.toLowerCase();
                if(nombreprod.includes(valor_buscar) || descri_c.includes(valor_buscar)) valores_encontrados.push(producto);
            }
            content_clear_filter.innerHTML = `<button class="btn btn-primary" title="Quitar filtro" type="button">X</button>`;
            this.setStorage(this.KEY_FILTER, `${valor}`);
            this.renderListaDeProductos(valores_encontrados);
        }
    }
}

input_search.addEventListener('input', e => Controller.filtrarProductoDelCatalogo(e.target.value));
document.addEventListener('DOMContentLoaded', e => {
    Controller = new HandlerProductosEnCategoria();
    let lastpag = Controller.getStorage(Controller.KEY_LASTPAG);
    Controller.renderListaDeProductos(JSON_PRODUCTOS);
    let ult_filtro = Controller.getStorage(Controller.KEY_FILTER);
    if(ult_filtro){
        input_search.value = ult_filtro;
        Controller.filtrarProductoDelCatalogo(ult_filtro);
        input_search.focus();
    }
    if(lastpag) $("#paginador").pagination('go', parseInt(lastpag));
})