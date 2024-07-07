let btn_selector_img = document.getElementById('btn_selector_img');
let input_search_img = document.getElementById('input_search_img');
let content_selector_img = document.getElementById('content_selector_img');

// Selector de imagenes
function renderSelectorImagenes(array_imgs){
    if(array_imgs.length == 0){
        $("#paginador").html("");
        content_selector_img.innerHTML = `
            <p class="text-muted small">No se encontraron imágenes...</p>
        `;
    }
    else if(array_imgs.length <= 20){
        $("#paginador").html("");
        content_selector_img.innerHTML = ``;
        let output = obtenerTarjetasSelectorImg(array_imgs);
        $(content_selector_img).append(output);
    }
    else{
        $('#paginador').pagination({
            dataSource: array_imgs,
            pageSize: 20,
            callback: function(data, pagination) {
                content_selector_img.innerHTML = ``;
                let output = obtenerTarjetasSelectorImg(data);
                $(content_selector_img).append(output);
            }
        })
    }
}

function obtenerTarjetasSelectorImg(array_imgs){
    let output_html = ``;
    for(let img of array_imgs){
        output_html += `
            <article class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 d-flex">
                <div class="d-flex justify-content-end align-items-center flex-column h-100 overflow-hidden">
                    <a href="${img.url_image}" data-lightbox="image-${img._id}" data-title="${img.name}"><img src="${img.url_image}" class="img-fluid rounded shadow-sm" alt="img_not_found" /></a>
                    <div class="w-100 text-card text-center">${img.name}</div>
                    <button class="btn btn-primary" type="button" title="Seleccionar ${img.name}" onclick="seleccionarImagen('${img._id}')">Seleccionar</button>
                </div>
            </article>
        `;
    }
    return output_html;
}

function filtrarImagenes(valor){
    let valor_buscar = valor.toLowerCase();
    if(valor.length == 0){
        renderSelectorImagenes(JSON_IMAGENES);
    }
    else{
        let valores_filtrados = [];
        for(let img of JSON_IMAGENES){
            let nombre_imagen = img.name.toLowerCase();
            if(nombre_imagen.includes(valor_buscar)){
                valores_filtrados.push(img);
            }
            renderSelectorImagenes(valores_filtrados);
        }
    }
}

function seleccionarImagen(id_img){
    let imagen = JSON_IMAGENES.find( element => element._id == id_img);
    if(!imagen) throw new Error("No se encontró la imagen con _id = " + id_img);
    input_imagen.value = imagen.url_image;
    vista_previa.innerHTML = `
        <img src="${imagen.url_image}" style="max-width:250px;max-height:300px" class="rounded shadow-sm" alt="img_not_found">
    `;
    $("#modalSelectorDeImagenes").modal("hide");
}
// fin selecgor de imágenes

btn_selector_img.addEventListener('click', e => {$("#modalSelectorDeImagenes").modal('show')})
input_search_img.addEventListener('keyup', e => filtrarImagenes(e.target.value));
document.addEventListener('DOMContentLoaded', e => {
    $('#input_descri_l').trumbowyg();
    renderSelectorImagenes(JSON_IMAGENES);
})