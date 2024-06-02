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

function validarNombre(valor){
    let regBl = /[<>\'\"\`\$\=]+/;
    if(valor.length == 0){
        VIT.nombre = false;
        input_nombre.classList.add("is-invalid");
        msgNombre.innerHTML = `Ingrese un nombre!`;
    } 
    else if(valor.length < 3){
        VIT.nombre = false;
        input_nombre.classList.add("is-invalid");
        msgNombre.innerHTML = `El nombre parece incompleto, debe contener mínimo 3 caracteres.`;
    }
    else if(valor.length > 255){
        VIT.nombre = false;
        input_nombre.classList.add("is-invalid");
        msgNombre.innerHTML = `El nombre ingresado es demasiado largo. No debe tener más de 255 caracteres.`;
    }
    else if(regBl.test(valor)){
        VIT.nombre = false;
        input_nombre.classList.add("is-invalid");
        msgNombre.innerHTML = `El nombre ingresado es inválido!`;
    }
    else{
        VIT.nombre = true;
        input_nombre.classList.remove("is-invalid");
        msgNombre.innerHTML = ``;
    }
}

function validarEmail(valor){
    let regEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(valor.length == 0){
        VIT.email = false;
        input_email.classList.add("is-invalid");
        msgEmail.innerHTML = `El email del usuario es obligatorio!`;
    }
    else if(valor.length < 4){
        VIT.email = false;
        input_email.classList.add("is-invalid");
        msgEmail.innerHTML = `El email ingresado parece inválido, pruebe con otro.`;
    }
    else if(valor.length > 500){
        VIT.email = false;
        input_email.classList.add("is-invalid");
        msgEmail.innerHTML = `El email ingresado es demasiado largo!`;
    }
    else if(!regEmail.test(valor)){
        VIT.email = false;
        input_email.classList.add("is-invalid");
        msgEmail.innerHTML = `El email ingresado no es válido!`;
    }
    else{
        VIT.email = true;
        input_email.classList.remove("is-invalid");
        msgEmail.innerHTML = ``;
    }
}

function validarTelefono(valor){
    if(valor.length > 0){
        if(valor.length < 4){
            VIT.telefono = false;
            input_telefono.classList.add("is-invalid");
            msgTelefono.innerHTML = 'EL número de teléfono ingresado parece incompleto, pruebe con otro.';
        }
        else if(valor.length > 50){
            VIT.telefono = false;
            input_telefono.classList.add("is-invalid");
            msgTelefono.innerHTML = 'EL número de teléfono ingresado no es válido!';
        }
        else{
            VIT.telefono = true;
            input_telefono.classList.remove("is-invalid");
            msgTelefono.innerHTML = '';
        }
    }
    else{
        VIT.telefono = true;
        input_telefono.classList.remove("is-invalid");
        msgTelefono.innerHTML = '';
    }
}

function validarContrasena(valor){
    let regPass = /[<>\'\"\`\=]+/;
    if(valor.length == 0){
        VIT.contrasena = false;
        input_contrasena.classList.add("is-invalid");
        msgContrasena.innerHTML = `La contraseña es obligatoria!`;
    }
    else if(valor.length < 5){
        VIT.contrasena = false;
        input_contrasena.classList.add("is-invalid");
        msgContrasena.innerHTML = `La contraseña debe tener mínimo 5 caracteres!`;
    }
    else if(valor.length > 500){
        VIT.contrasena = false;
        input_contrasena.classList.add("is-invalid");
        msgContrasena.innerHTML = `La contraseña ingresada es demasiado larga!`;
    }
    else if(regPass.test(valor)){
        VIT.contrasena = false;
        input_contrasena.classList.add("is-invalid");
        msgContrasena.innerHTML = `La contraseña no es válida, ingrese otra sin utilizar caracteres especiales.`;
    }
    else{
        VIT.contrasena = true;
        input_contrasena.classList.remove("is-invalid");
        msgContrasena.innerHTML = ``;
    }

}

function sanitizarInputTelefono(){
    input_telefono.value = input_telefono.value.replace(/[^0-9]/g, '');
}

input_contrasena.addEventListener('change', e => validarContrasena(e.target.value));
input_telefono.addEventListener('change', e => validarTelefono(e.target.value))
input_telefono.addEventListener('keyup', e => sanitizarInputTelefono());
input_email.addEventListener('change', e => validarEmail(e.target.value));
input_nombre.addEventListener('change', e => validarNombre(e.target.value));
form_usuario.addEventListener('submit', e => {
    e.preventDefault();
    validarNombre(input_nombre.value);
    validarContrasena(input_contrasena.value);
    validarEmail(input_email.value);
    validarTelefono(input_telefono.value);
    if(VIT.nombre && VIT.email && VIT.contrasena && VIT.telefono){
        button_submit.setAttribute('disable', '');
        button_submit.innerHTML = `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> Cargando...
        `;
        form_usuario.submit();
    }
})