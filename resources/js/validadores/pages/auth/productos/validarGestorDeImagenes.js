let form_images = document.getElementById('form_images');
let button_open_form_imgs = document.getElementById('button_open_form_imgs');
let input_files = document.getElementById('input_files');
let images_list_ready = document.getElementById('images_list_ready');
let content_btns_submit = document.getElementById('content_btns_submit');
let msgImagenes = document.getElementById('msgImagenes');
let loading_msg = document.getElementById('loading_msg');
let regValidImgs = /.gif|.bmp|.jpg|.jpeg$/;
let imagenes_validas = [];
let imagenes_invalidas = [];
let form_valid = false;

function validarImagen(file){
    if(regValidImgs.test(file.name)){
        return true;
    }
    else{
        return false
    }
}

function reiniciarSelectorDeImagenes(){
    input_files.value = '';
    msgImagenes.innerHTML = ``;
    images_list_ready.innerHTML = ``;
    content_btns_submit.innerHTML = ``;
}

function verificarImagenes(){
    imagenes_validas = [];
    imagenes_invalidas = [];
    for(let file of input_files.files){
        validarImagen(file) ? imagenes_validas.push(file) : imagenes_invalidas.push(file);
    }

    let output_html = `<ul class="list-group list-group-flush">`;
    for(let file of imagenes_invalidas){
        let objectURL = URL.createObjectURL(file);
        output_html += `<li class="list-group-item"><i class="bi bi-x-circle-fill text-danger"></i> <img src="${objectURL}" class="rounded shadow-sm" style="max-width:20px;max-height:25px;" title="${file.name}" /> ${file.name} (Extensión no válida)</li>`;
    }
    for(let file of imagenes_validas){
        let objectURL = URL.createObjectURL(file);
        output_html += `<li class="list-group-item"><i class="bi bi-check-circle-fill text-success"></i> <img src="${objectURL}" class="rounded shadow-sm" style="max-width:20px;max-height:25px;" title="${file.name}" /> ${file.name}</li>`;
    }
    output_html += `</ul>`;
    $(images_list_ready).html('');
    $(images_list_ready).append(output_html);
    if(imagenes_invalidas.length == 0){
        msgImagenes.innerHTML = ``;
        form_valid = true;
        $(content_btns_submit).html(`<button class="btn btn-primary m-2" id="button_submit" type="submit" title="Guardar imágenes preparadas">Subir imágenes</button><button class="btn btn-dark" id="button_reset" type="button" onclick="reiniciarSelectorDeImagenes()" title="Reiniciar la subida de imágnes">Reiniciar selector</button>`);
    }
    else{
        msgImagenes.innerHTML = `Hay imagenes que no son válidas. No es posible guardar. Intente nuevamente subir los archivos sin los que no son váilidos. revise en la lista.`;
        form_valid = false;
        $(content_btns_submit).html(`<button class="btn btn-dark" type="button" onclick="reiniciarSelectorDeImagenes()" title="Reiniciar la subida de imágnes">Reiniciar selector</button>`);
    }
}

input_files.addEventListener('change', e => verificarImagenes());
button_open_form_imgs.addEventListener('click', e => {$("#modalFormImagenes").modal('show')})
form_images.addEventListener('submit', e => {
    e.preventDefault();
    if(form_valid){
        let button_submit = document.getElementById('button_submit');
        let button_reset = document.getElementById('button_reset');
        button_reset.setAttribute('disabled', '');
        button_submit.setAttribute('disabled', '');
        loading_msg.innerHTML = `
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="text-center">
                <p>Subiendo las imágenes, por favor espere... Esto puede demorar según la cantidad de archivos a subir.</p>
            </div>
        `;
        form_images.submit();
    }
})