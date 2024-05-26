let form_usuario = document.querySelector('form');
let input_nombre = document.getElementById('input_nombre');
let msgNombre = document.getElementById('msgNombre');
let input_email = document.getElementById('input_email');
let msgEmail = document.getElementById('msgEmail');
let input_telefono = document.getElementById('input_telefono');
let msgTelefono = document.getElementById('msgTelefono');
let input_contrasena = document.getElementById('input_contrasena');
let msgContrasena = document.getElementById('msgContrasena');
let check_notificacion = document.getElementById('check_notificacion');
let button_submit = document.getElementById('button_submit');
const VIT = {
    nombre : false,
    email : false,
    telefono : false,
    contrasena : false
}

form_usuario.addEventListener('submit', e => {
    e.preventDefault();
    
})