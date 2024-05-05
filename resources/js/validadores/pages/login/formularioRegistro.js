let form_registro = document.querySelector('form');
let input_nombre = document.getElementById('input_nombre');
let msgNombre = document.getElementById('msgNombre');
let input_email = document.getElementById('input_email');
let msgEmail = document.getElementById('msgEmail');
let input_telefono = document.getElementById('input_telefono');
let msgTelefono = document.getElementById('msgTelefono');
let input_password = document.getElementById('input_password');
let msgPassword = document.getElementById('msgPass');
let input_repass = document.getElementById('input_repass');
let msgRepass = document.getElementById('msgRePass');
let input_mensaje_solicitud = document.getElementById('input_mensaje_solicitud');
let msgMesaje = document.getElementById('msgMesaje');
let contador_char = document.getElementById('contador_char');
let button_submit = document.getElementById('button_submit');
let button_show_pass = document.getElementById('button_show_pass');
let mostrar_contrasena = false;
const VIT = {
    nombre : false,
    email : false,
    password : false,
    telefono : false,
    mensaje : false
}

function validarNombre(valor){
    let regWL = /^[a-zA-Z0-9\-\_\.\&]+$/;
    if(valor.length == 0){
        VIT.nombre = false;
        input_nombre.classList.add("is-invalid");
        msgNombre.innerHTML = `Ingrese un nombre de usuario!`;
    }
    else if(valor.length < 4){
        VIT.nombre = false;
        input_nombre.classList.add("is-invalid");
        msgNombre.innerHTML = `El nombre de usuario es muy corto, debe tener más de 4 caracteres.`;
    }
    else if(valor.length > 255){
        VIT.nombre = false;
        input_nombre.classList.add("is-invalid");
        msgNombre.innerHTML = `El nombre de usuario es muy largo, no debe superar los 255 caracteres.`;
    }
    else if(!regWL.test(valor)){
        VIT.nombre = false;
        input_nombre.classList.add("is-invalid");
        msgNombre.innerHTML = `El nombre de usuario no es válido. Evite utilizar espacios o caracteres especiales. Solo guiones "-", guiones bajos "_" o puntos "." Por ejemplo: fulanito-11`;
    }
    else{
        VIT.nombre = true;
        input_nombre.classList.remove("is-invalid");
        msgNombre.innerHTML = ``;
    }
}

function validarEmail(valor){
    let regEmail = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/; 
    if(valor.length == 0){
        VIT.email = false;
        input_email.classList.add('is-invalid');
        msgEmail.innerHTML = `Ingrese un email!`;
    }
    else if(valor.length < 4){
        VIT.email = false;
        input_email.classList.add('is-invalid');
        msgEmail.innerHTML = `El email ingresado parece incompleto o es inválido.`;
    }
    else if(valor.length > 255){
        VIT.email = false;
        input_email.classList.add('is-invalid');
        msgEmail.innerHTML = `El email ingresado es demasiado largo, no debe superar los 255 caracteres!`;
    }
    else if(!regEmail.test(valor)){
        VIT.email = false;
        input_email.classList.add('is-invalid');
        msgEmail.innerHTML = `El email ingresado es inválido!`;
    }
    else{
        VIT.email = true;
        input_email.classList.remove('is-invalid');
        msgEmail.innerHTML = ``;
    }
}

function validarTelefono(valor){
    if(valor.length == 0){
        VIT.telefono = false;
        input_telefono.classList.add("is-invalid");
        msgTelefono.innerHTML = `Ingrese un número de teléfono!`;
    }
    else if(valor.length < 6){
        VIT.telefono = false;
        input_telefono.classList.add("is-invalid");
        msgTelefono.innerHTML = `El formato del teléfono ingresado parece incompleto o es inválido.`;
    }
    else if(valor.length > 25){
        VIT.telefono = false;
        input_telefono.classList.add("is-invalid");
        msgTelefono.innerHTML = `El teléfono ingresado es demasiado largo!`;
    }
    else{
        VIT.telefono = true;
        input_telefono.classList.remove("is-invalid");
        msgTelefono.innerHTML = ``;
    }
}

function sanitizarTelefono(){
    let valor_actual = input_telefono.value;
    let numeros = valor_actual.replace(/\D/g, ''); // Filtrar solo números
    if(valor_actual !== numeros){
        input_telefono.value = numeros;
    }
}

function validarContrasena(valor){
    let regBL = /[<>\'\"\`\=\[\]\{\}]+/;
    if(valor.length == 0){
        VIT.password = false;
        input_password.classList.add('is-invalid');
        msgPassword.innerHTML = `Ingrese la contraseña!`;
    }
    else if(valor.length < 4){
        VIT.password = false;
        input_password.classList.add('is-invalid');
        msgPassword.innerHTML = `La contraseña ingresada parece incompleta`;
    }
    else if(valor.lengt > 255){
        VIT.password = false;
        input_password.classList.add('is-invalid');
        msgPassword.innerHTML = `La contraseña ingresada es demasiado larga.`;
    }
    else if(regBL.test(valor)){
        VIT.password = false;
        input_password.classList.add('is-invalid');
        msgPassword.innerHTML = `Contraseña inválida, evite utilizar caracteres especiales.`;
    }
    else{
        if(valor === input_repass.value){
            VIT.password = true;
            input_repass.classList.remove('is-invalid');
            input_password.classList.remove('is-invalid');
            msgPassword.innerHTML = ``;
            msgRepass.innerHTML = ``;
        }
        else{
            VIT.password = false;
            input_repass.classList.add('is-invalid');
            input_password.classList.add('is-invalid');
            msgPassword.innerHTML = ``;
            msgRepass.innerHTML = `La contraseña no coinciden!`;
        }
    }
}

function validarReContrasena(valor){
    let regBL = /[<>\'\"\`\=\[\]\{\}]+/;
    if(valor.length == 0){
        VIT.pass = false;
        input_repass.classList.add('is-invalid');
        msgRepass.innerHTML = `Ingrese la contraseña!`;
    }
    else if(valor.length < 4){
        VIT.pass = false;
        input_repass.classList.add('is-invalid');
        msgRepass.innerHTML = `La contraseña ingresada parece incompleta`;
    }
    else if(valor.lengt > 255){
        VIT.pass = false;
        input_repass.classList.add('is-invalid');
        msgRepass.innerHTML = `La contraseña ingresada es demasiado larga.`;
    }
    else if(regBL.test(valor)){
        VIT.pass = false;
        input_repass.classList.add('is-invalid');
        msgRepass.innerHTML = `Contraseña inválida, evite utilizar caracteres especiales.`;
    }
    else{
        if(input_password.value === input_repass.value){
            VIT.pass = true;
            input_repass.classList.remove('is-invalid');
            msgRepass.innerHTML = ``;
        }
        else{
            VIT.pass = false;
            input_repass.classList.add('is-invalid');
            msgRepass.innerHTML = `La contraseña no coinciden!`;
        }
    }
}

function validarMensaje(valor){
    let regBL = /[<>\'\"\`\=]+/;
    if(valor.length > 0){
        if(valor.lengt < 3){
            VIT.mensaje = false;
            input_mensaje_solicitud.classList.add("is-invalid");
            msgMesaje.innerHTML = 'Ingrese un mensaje más claro.';
        }
        else if(valor.lengt > 255){
            VIT.mensaje = false;
            input_mensaje_solicitud.classList.add("is-invalid");
            msgMesaje.innerHTML = 'Se ha superado el máximo de 255 caracteres!';
        }
        else if(regBL.test(valor)){
            VIT.mensaje = false;
            input_mensaje_solicitud.classList.add("is-invalid");
            msgMesaje.innerHTML = 'El mensaje ingresado no es válido. Evite utilizar caracteres especiales.';
        }
        else{
            VIT.mensaje = true;
            input_mensaje_solicitud.classList.remove("is-invalid");
            msgMesaje.innerHTML = '';
        }
    }
    else{
        VIT.mensaje = true;
        input_mensaje_solicitud.classList.remove("is-invalid");
        msgMesaje.innerHTML = '';
    }
}

function contarCaracteres(valor){
    contador_char.innerHTML = valor.length;
}

function cambiarTipoDeInputPass(){
    if(mostrar_contrasena){
        mostrar_contrasena = false;
        input_password.type = 'password';
        input_password.title = 'Mostrar contraseña';
        button_show_pass.innerHTML = `<i class="bi bi-eye"></i>`;
    }
    else{
        mostrar_contrasena = true;
        input_password.type = 'text';
        input_password.title = 'Ocultar contraseña';
        button_show_pass.innerHTML = `<i class="bi bi-eye-slash"></i>`;
    }
}

button_show_pass.addEventListener('click', e => {cambiarTipoDeInputPass()})
input_nombre.addEventListener('change', e => {validarNombre(e.target.value)});
input_email.addEventListener('change', e => validarEmail(e.target.value));
input_telefono.addEventListener('change', e => validarTelefono(e.target.value));
input_telefono.addEventListener('input', e => sanitizarTelefono());
input_password.addEventListener('change', e => validarContrasena(e.target.value));
input_mensaje_solicitud.addEventListener('change', e => validarMensaje(e.target.value));
input_mensaje_solicitud.addEventListener('keyup', e => contarCaracteres(e.target.value));
form_registro.addEventListener('submit', e => {
    e.preventDefault();
    validarNombre(input_nombre.value);
    validarEmail(input_email.value);
    validarTelefono(input_telefono.value);
    validarContrasena(input_password.value);
    validarMensaje(input_mensaje_solicitud.value);
    if(VIT.nombre && VIT.email && VIT.telefono && VIT.password && VIT.mensaje){
        button_submit.setAttribute('disabled', '');
        button_submit.innerHTML = `
        <div class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div> Registrando...
        `;
        form_registro.submit();
    }
})