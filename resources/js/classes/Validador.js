class Validador{
    constructor(){
        this.regBl = /[<>\'\"\`\=]+/;
        this.regWlString = /^[a-zA-ZÀ-ÿ0-9\s,.:;'"()¿?¡!-]*$/;
        this.regString = /[a-zA-Z0-9\s]+/;
        this.regNumber = /[0-9]+/;
        this.regEmail = /^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,6}$/;
        this.regImagenes = /.gif|.bmp|.png|.jpg|.jpeg$/;
        this.regVid = /.mp4|.webm$/;
    }

    validarNombre(valor, lengthMin = 3, lengthMax = 255){
        if(valor.length == 0){
            return {
                valid : false,
                msg : "El nombre es obligatorio."
            }
        }
        else if(valor.length < lengthMin){
            return {
                valid : false,
                msg : "El nombre ingresado es muy corto."
            }
        }
        else if(valor.length > lengthMax){
            return {
                valid : false,
                msg : `El nombre es demasiado largo, no debe superar los ${lengthMax} caracteres.`
            }
        }
        else if(this.regBl.test(valor)){
            return {
                valid : false,
                msg : "El nombre ingresado es inválido. Evite utilizar caracteres escpeiales."
            }
        }
        else{
            return {
                valid : true,
                msg : ""
            }
        }
    }

    validarString(valor, lengthMin = 1, lengthMax = 255, regValid = this.regString){
        if(valor.length == 0){
            return {
                valid : false,
                msg : "Ingrese un valor para este campo."
            }
        }
        else if(valor.length < lengthMin){
            return {
                valid : false,
                msg : `El valor ingresado debe contener mínimo ${lengthMin} caracteres.`
            }
        }
        else if(valor.length > lengthMax){
            return {
                valid : false,
                msg : `El valor ingresado es demasiado largo, no debe superar los ${lengthMax} caracteres.`
            }
        }
        else if(!regValid.test(valor)){
            return {
                valid : false,
                msg : "El valor ingresado no es válido!"
            }
        }
        else{
            return {
                valid : true,
                msg : ""
            }
        }
    }

    validarEmail(valor, lengthMax = 255){
        if(valor.length == 0){
            return {
                valid : false,
                msg : "Ingrese un email!"
            }
        }
        else if(valor.length > lengthMax){
            return {
                valid : false,
                msg : `El email ingresado es demasiado largo, no debe superar los ${lengthMax} caracteres.`
            }
        }
        else if(!this.regEmail.test(valor)){
            return {
                valid : false,
                msg : "El email ingresado no es válido!"
            }
        }
        else{
            return {
                valid : true,
                msg : ""
            }
        }
    }

    validarContrasenaLevel1(valor, lengthMin = 4, lengthMax = 255){
        if(valor.length == 0){
            return {
                valid : false,
                msg : "Ingrese una contraseña!"
            }
        }
        else if(valor.length < lengthMin){
            return {
                valid : false,
                msg : "La contraseña es muy corta"
            }
        }
        else if(valor.length > lengthMax){
            return {
                valid : false,
                msg : `El email ingresado es demasiado largo. No debe superar los ${lengthMax} caracteres!`
            }
        }
        else if(this.regBl.test(valor)){
            return {
                valid : false,
                msg : "La contraseña no es válida. Intente con otros caracteres."
            }
        }
        else{
            return {
                valid : true,
                msg : ""
            }
        }
    }

    validarSelector(input_selector){
        let valor = null;
        for(let opcion of input_selector){
            if(opcion.selected) valor = opcion.value;
        }
        if(valor == null || valor <= 0){
            return {
                valid : false,
                msg : "Seleccione una opción!"
            } 
        }
        else{
            return {
                valid : true,
                msg : ""
            }
        }
    }

    validarImagen(file, maxSize = 0){
        if(!file || file == undefined || !file.name){
            return {
                valid : false,
                msg : "Falta seleccionar archivos!"
            } 
        }
        else if(!this.regImagenes.test(file.name)){
            return {
                valid : false,
                msg : "Extensión no válida!"
            } 
        }
        else if(maxSize > 0){
            if(file.size > maxSize){
                return {
                    valid : false,
                    msg : "El archivo es demasiado pesado."
                } 
            }
        }
        else{
            return {
                valid : true,
                msg : ""
            } 
        }
    }

    validarNumero(valor, rango = false, min = 0, max = 0){
        if(valor == '' || valor == undefined || isNaN(valor)){
            return {
                valid : false,
                msg : "Ingrese un valor!"
            }
        }
        else if(rango){
            if(valor < min){
                return {
                    valid : false,
                    msg : `El valor a ingresar debe superar el valor mínimo de ${min}`
                }
            }
            else if(valor > max){
                return {
                    valid : false,
                    msg : `El valor a ingresar no debe superar el valor máximo de ${max}`
                }
            }
            else{
                return {
                    valid : true,
                    msg : ""
                }
            }
        }
        else{
            return {
                valid : true,
                msg : ""
            }
        }
    }

    validarValorPrecio(valor){
        if(valor == '' || isNaN(valor)){
            return {
                valid : false,
                msg : "Ingrese un valor de precio."
            };
        }
        else if(valor < 0){
            return {
                valid : false,
                msg : "Ingrese un valor de precio positivo."
            };
        }
        else{
            return {
                valid : true,
                msg : ""
            };
        }
    }

    loader1Html(){
        return `<div class="d-flex justify-content-center align-items-center"><div class="loader-1"></div></div>`;
    }

    spinnerSmHtml(){
        return `<div class="spinner-border spinner-border-sm" role="status">
        <span class="visually-hidden">Loading...</span>
        </div>`;
    }
}