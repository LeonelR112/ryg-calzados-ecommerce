class Validador{
    constructor(){
        this.regBl = /[<>\'\"\`\=]+/;
        this.regString = /[a-zA-Z0-9\s]+/;
        this.regNumber = /[0-9]+/;
        this.regEmail = /^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,6}$/;
        this.regImagenes = /.gif|.bmp|.png|.jpg|.jpeg$/;
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

    loader1Html(){
        return `<div class="d-flex justify-content-center align-items-center"><div class="loader-1"></div></div>`;
    }
}