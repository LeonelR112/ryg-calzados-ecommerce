let form_imagenes = document.querySelector('form');
let input_nombrecat = document.getElementById('input_nombrecat');
let msgNombrecat = document.getElementById('msgNombrecat');
let input_orden = document.getElementById('input_orden');
let msgOrden = document.getElementById('msgOrden');
let input_descri_c = document.getElementById('input_descri_c');
let msgDescriC = document.getElementById('msgDescriC');
let count_chars_descric = document.getElementById('count_chars_descric');
let input_descri_l = document.getElementById('input_descri_l');
let msgDescriL = document.getElementById('msgDescriL');
let input_imagen = document.getElementById('input_imagen');
let msgImagen = document.getElementById('msgImagen');
let vista_previa = document.getElementById('vista_previa');
let input_color = document.getElementById('input_color');
let msgColor  =document.getElementById('msgColor');
let button_submit = document.getElementById('button_submit');
const VIT = {
    nombre : false,
    orden : false,
    descri_c : false
}

function validarNombre(valor){
    let regBl = /[<>\'\"\`\=]+/;
    if(valor.lenght == 0){
        VIT.nombre = false;
        input_nombrecat.classList.add("is-invalid");
        msgNombrecat.innerText = 'Ingrese un nombre para la categoría!';
    }
    else if(valor.lenght > 2){
        VIT.nombre = false;
        input_nombrecat.classList.add("is-invalid");
        msgNombrecat.innerText = 'El nombre de cateogría es muy corto!';
    }
    else if(valor.lenght > 255){
        VIT.nombre = false;
        input_nombrecat.classList.add("is-invalid");
        msgNombrecat.innerText = 'El nombre de categoría es muy largo!';
    }
    else if(regBl.test(valor)){
        VIT.nombre = false;
        input_nombrecat.classList.add("is-invalid");
        msgNombrecat.innerText = 'El nombre ingresado es inválido!';
    }
    else{
        VIT.nombre = true;
        input_nombrecat.classList.remove("is-invalid");
        msgNombrecat.innerText = '';
    }
}

function validarOrden(valor){
    if(valor == '' || isNaN(valor)){
        VIT.orden = false;
        input_orden.classList.add('is-invalid');
        msgOrden.innerText = 'Ingrese un número de orden!';
    }
    else{
        VIT.orden = true;
        input_orden.classList.remove('is-invalid');
        msgOrden.innerText = '';
    }
}

function validarDescripcionCorta(valor){
    let regBl = /[<>\'\`\=]+/;
    if(valor.lenght == 0){
        VIT.descri_c = false;
        input_descri_c.classList.add("is-invalid");
        msgDescriC.innerHTML = 'Ingrese una descripción corta para esta categoría!';
    }
    else if(valor.lenght < 3){
        VIT.descri_c = false;
        input_descri_c.classList.add("is-invalid");
        msgDescriC.innerHTML = 'Ingrese una descripción más razonable!';
    }
    else if(valor.length > 500){
        VIT.descri_c = false;
        input_descri_c.classList.add("is-invalid");
        msgDescriC.innerHTML = 'La descripción es demasiada larga. No debe superar los 500 caracteres.';
    }
    else if(regBl.test(valor)){
        VIT.descri_c = false;
        input_descri_c.classList.add("is-invalid");
        msgDescriC.innerHTML = 'Descripción ingresada no es válida. Evite utilizar caracteres especiales.';
    }
    else{
        VIT.descri_c = true;
        input_descri_c.classList.remove("is-invalid");
        msgDescriC.innerHTML = '';
    }
}

input_nombrecat.addEventListener('change', e => validarNombre(e.target.value));
input_orden.addEventListener('change', e => validarOrden(e.target.value));
input_descri_c.addEventListener('change', e => validarDescripcionCorta(e.target.value));
form_imagenes.addEventListener('submit',e => {
    e.preventDefault();
    validarNombre(input_nombrecat.value);
    validarOrden(input_orden.value);
    validarDescripcionCorta(input_descri_c.value);
    if(VIT.nombre && VIT.orden && VIT.descri_c){
        button_submit.setAttribute('disabled', '');
        button_submit.innerHTML = `
            <div class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
            </div> Cargando...
        `;
        form_imagenes.submit();
    }
})