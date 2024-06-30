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
const VIT = {
    nombre : false,
    orden : false,
    descri_c : false,
    descri_l : false,
    imagen : false,
    color : false
}

form_imagenes.addEventListener('submit',e => {
    e.preventDefault();
})