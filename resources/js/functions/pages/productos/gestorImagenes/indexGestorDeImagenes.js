let content_images = document.getElementById('content_images');
let form_del = document.getElementById('form_del');
let input_del_name_file = document.getElementById('input_del_name_file');
let input_search = document.getElementById('input_search');

function renderImagenes(array_imgs){
    if(array_imgs.length == 0){
        $("#paginador").html("");
        content_images.innerHTML = `
            <div class="col-12">
                <p class="text-muted small">No se han encontrado imágenes...</p>
            </div>
        `;
    }
    else if(array_imgs.length <= 20){
        $("#paginador").html("");
        content_images.innerHTML = ``;
        let output = obtenerGrillaDeImagenes(array_imgs);
        $(content_images).append(output);
    }
    else{
        $('#paginador').pagination({
            dataSource: array_imgs,
            pageSize: 20,
            callback: function(data, pagination) {
                content_images.innerHTML = ``;
                let output = obtenerGrillaDeImagenes(data);
                $(content_images).append(output);
            }
        })
    }
}

function borrarImagen(id){
    let imagen = JSON_IMAGENES.find( element => element._id == id);
    if(!imagen) throw new Error("No se encontró la imagen con id " + id);
    Swal.fire({
        title: "¿Borrar imagen?",
        html: `Está a punto de eliminar elarchivo <b>${imagen.name}</b> del sistema. Tenga en cuenta que si esta foto se encuentra en uso en algún producto o categoría, se generará problemas de visualización.</p>`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si, borrar",
        cancelButtonText : "Cancelar"
    }).then((result) => {
        if(result.isConfirmed) {
           let btn_del = document.getElementById(`btn_del_${id}`);
           btn_del.setAttribute('disabled', '');
           btn_del.innerHTML = `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
           `;
           input_del_name_file.value = imagen.name;
           form_del.submit();
        }
    });
}

function obtenerGrillaDeImagenes(array_imgs){
    let output_html = '';
    for(let img of array_imgs){
        output_html += `
            <article class="col-6 col-md-4 col-lg-3 col-xxl-2 d-flex justify-content-end align-items-center flex-column">
                <a href="${img.url_image}" data-lightbox="image-${img._id}" data-title="${img.name}"><img src="${img.url_image}" class="img-fluid rounded shadow-sm mb-1" /></a>
                <div class="w-100">
                    <p class="mb-0 text-muted small text-center text-card">${img.name}</p>
                </div>
                <div class="text-center w-100">
                    <button class="btn btn-danger btn-sm" onclick="borrarImagen('${img._id}')" id="btn_del_${img._id}" type="button" title="Borrar ${img.name}"><i class="bi bi-trash"></i> Borrar</button>
                </div>
            </article>
        `;
    }
    return output_html;
}

function filtrarImagenes(valor){
    let valor_filtrar = valor.toLowerCase();
    if(valor_filtrar.length == 0){
        renderImagenes(JSON_IMAGENES);
    }
    else{
        let valores_filtrados = [];
        for(let img of JSON_IMAGENES){
            let nombre_lower = img.name.toLowerCase();
            if(nombre_lower.includes(valor)) valores_filtrados.push(img);
        }
        renderImagenes(valores_filtrados);
    }
}

input_search.addEventListener('keyup', e => filtrarImagenes(e.target.value));
document.addEventListener('DOMContentLoaded', e => {
    renderImagenes(JSON_IMAGENES);
})