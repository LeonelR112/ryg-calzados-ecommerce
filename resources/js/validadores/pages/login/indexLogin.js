let form_login = document.querySelector('form');
let input_email = document.getElementById('input_email');
let msgEmail = document.getElementById('msgEmail');
let input_pass = document.getElementById('input_pass');
let msgPass = document.getElementById('msgPass');
let button_submit = document.getElementById('button_submit');
let button_show_pass = document.getElementById('button_show_pass');
let mostrar_contrasena = false;
const VIT = {
    email : false,
    pass : false
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

function validarContrasena(valor){
    let regBL = /[<>\'\"\`\=\[\]\{\}]+/;
    if(valor.length == 0){
        VIT.pass = false;
        input_pass.classList.add('is-invalid');
        msgPass.innerHTML = `Ingrese la contraseña!`;
    }
    else if(valor.length < 4){
        VIT.pass = false;
        input_pass.classList.add('is-invalid');
        msgPass.innerHTML = `La contraseña ingresada parece incompleta`;
    }
    else if(valor.lengt > 255){
        VIT.pass = false;
        input_pass.classList.add('is-invalid');
        msgPass.innerHTML = `La contraseña ingresada es demasiado larga.`;
    }
    else if(regBL.test(valor)){
        VIT.pass = false;
        input_pass.classList.add('is-invalid');
        msgPass.innerHTML = `Contraseña inválida, evite utilizar caracteres especiales.`;
    }
    else{
        VIT.pass = true;
        input_pass.classList.remove('is-invalid');
        msgPass.innerHTML = ``;
    }
}

function cambiarTipoDeInputPass(){
    if(mostrar_contrasena){
        mostrar_contrasena = false;
        input_pass.type = 'password';
        input_pass.title = 'Mostrar contraseña';
        button_show_pass.innerHTML = `<i class="bi bi-eye"></i>`;
    }
    else{
        mostrar_contrasena = true;
        input_pass.type = 'text';
        input_pass.title = 'Ocultar contraseña';
        button_show_pass.innerHTML = `<i class="bi bi-eye-slash"></i>`;
    }
}

input_email.addEventListener('change', e => {validarEmail(e.target.value)});
input_pass.addEventListener('change', e => {validarContrasena(e.target.value)});
button_show_pass.addEventListener('click', e => {cambiarTipoDeInputPass()})
form_login.addEventListener('submit', e => {
    e.preventDefault();
    validarEmail(input_email.value);
    validarContrasena(input_pass.value);
    if(VIT.email && VIT.pass){
        button_submit.setAttribute('disabled', '');
        button_submit.innerHTML = `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> Ingresando...
        `;
        form_login.submit();
    }
})