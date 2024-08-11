let SelectorIMGController = null;
let ValidadorForm = null;
let input_search_img = document.getElementById('input_search_img');
let content_selector_img = document.getElementById('content_selector_img');
let button_selector_img = document.getElementById('button_selector_img');
let content_imagenes_seleccionadas = document.getElementById('content_imagenes_seleccionadas');
let imagenes_pre_seleccionadas = [];
let form_producto = document.querySelector('form');
let input_nombreprod = document.getElementById('input_nombreprod');
let msgNombre = document.getElementById('msgNombre');
let input_nro_art = document.getElementById('input_nro_art');
let msgNroArt = document.getElementById('msgNroArt');
let input_orden = document.getElementById('input_orden');
let msgOrden = document.getElementById('msgOrden');
let input_precio = document.getElementById('input_precio');
let msgPrecio = document.getElementById('msgPrecio');
let input_precio_unitario = document.getElementById('input_precio_unitario');
let msgPrecioUnitario = document.getElementById('msgPrecioUnitario');
let talles_selector = document.getElementsByClassName('talles_selector');
let msgTalles = document.getElementById('msgTalles');
let input_descri_c = document.getElementById('input_descri_c');
let msgDescriC = document.getElementById('msgDescriC');
let count_chars_descri_c = document.getElementById('count_chars_descri_c');
let msgCategorias = document.getElementById('msgCategorias');
let msgImagenes = document.getElementById('msgImagenes');
let button_submit = document.getElementById('button_submit');
let json_input_imagenes_prod = document.getElementById('json_input_imagenes_prod');
const VALID_STATUS = {
    nombreprod : false,
    nro_art : false,
    orden : false,
    precio : false,
    precio_unit : false,
    talles : false,
    descri_c : false,
    categorias : false
}

// Selector de imágenens
class ImagenesHandler{
    renderSelectorImagenes(array_imagenes){
        if(array_imagenes.length == 0){
            $("#paginador").html("");
            content_selector_img.innerHTML = `
                <p class="small text-muted">No se encontraron imágenens...</p>
            `;
        }
        else if(array_imagenes.length <= 30){
            $("#paginador").html("");
            content_selector_img.innerHTML = ``;
            let output = this.obtenerTarjetasSelectoras(array_imagenes);
            $(content_selector_img).append(output);
        }
        else{
            $('#paginador').pagination({
                dataSource: array_imagenes,
                pageSize: 30,
                callback: (data, pagination) => {
                    content_selector_img.innerHTML = ``;
                    let output = this.obtenerTarjetasSelectoras(data);
                    $(content_selector_img).append(output);
                }
            })
        }
    }

    obtenerTarjetasSelectoras(array_imagenes){
        let output_html = '';
        for(let imagen of array_imagenes){
            output_html += `
                 <article class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="d-flex justify-content-end align-items-center flex-column h-100">
                        <a href="${imagen.url_image}" data-lightbox="image-${imagen._id}" data-title="${imagen.name}"><img src="${imagen.url_image}" id="img_preview" alt="img_not_found" class="img-fluid shadow-sm img-thubmnail flip-in-ver-left"/></a>
                        <div class="text-card text-center small p-1 w-100">
                            ${imagen.name}
                        </div>
                        <div class="w-100 text-center">
                            <button class="btn btn-primary btn-sm" type="button" onclick="SelectorIMGController.seleccionarImagen('${imagen._id}')" title="Seleccionar ${imagen.name}"><i class="bi bi-hand-index"></i> Seleccionar</button>
                        </div>
                    </div>
                </article>
            `;
        }
        return output_html;
    }

    seleccionarImagen(_id){
        let imagen = JSON_IMAGENES_SELECTOR.find( element => element._id == _id);
        if(!imagen) throw new Error("No se ha encontrado una imagen con id " + _id);
        let img_props = {
            ... imagen,
            principal : "N"
        }
        let existe_ya = imagenes_pre_seleccionadas.find( element => element._id == _id);
        if(existe_ya){
            Swal.fire({
                icon : "info",
                html : "Esta imagen ya fue agregada.",
                confirmButtonText : "Cerrar",
                toast : true
            });
        }
        else{
            imagenes_pre_seleccionadas.push(img_props);
            this.renderImagenesPreSeleccionadas(imagenes_pre_seleccionadas);
            $("#modalSelectorDeImagenes").modal("hide");
        }
    }

    renderImagenesPreSeleccionadas(array_preimg){
        let output_html = '';
        content_imagenes_seleccionadas.innerHTML = ``;
        if(array_preimg.length == 0){
            content_imagenes_seleccionadas.innerHTML = `<p class="text-muted text-center small fst-italic border p-2"><i class="bi bi-image"></i> <br> -Sin imágenes- </p>`;
        }
        else{
            for(let imagen of array_preimg){
                output_html += `
                    <article class="col-6 col-md-4 col-lg-3 col-xxl-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-end align-items-center flex-column h-100">
                                    <a href="${imagen.url_image}" data-lightbox="image-${imagen._id}" data-title="${imagen.name}"><img src="${imagen.url_image}" id="img_preview" alt="img_not_found" class="img-fluid shadow-sm img-thubmnail flip-in-ver-left"/></a>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end align-items-center flex-column">
                                        <div class="w-100 d-flex justify-content-center align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radio_img_principal" onchange="SelectorIMGController.actualizarPrincipal('${imagen._id}')" id="radio_img_principal_${imagen._id}" ${imagen.principal == 'S' ? 'checked' : ''}>
                                                <label class="form-check-label cursor-pointer" for="radio_img_principal_${imagen._id}">
                                                    Principal
                                                </label>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger btn-sm" type="button" onclick="SelectorIMGController.quitarSeleccion('${imagen._id}')" title="Quitar imagen"><i class="bi bi-trash3"></i> Quitar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                `;
            }
            $(content_imagenes_seleccionadas).append(output_html);
        }
    }

    actualizarPrincipal(_id){
        let imagen_quitar = imagenes_pre_seleccionadas.find( element => element._id == _id);
        if(!imagen_quitar) throw new Error("No se encontró una imagen seleccionada con id " + _id);
        let radio_img_principal = document.getElementById(`radio_img_principal_${_id}`);
        radio_img_principal.checked ? imagen_quitar.principal = 'S' : imagen_quitar.principal = 'N';
    }

    quitarSeleccion(_id){
        let imagen_quitar = imagenes_pre_seleccionadas.find( element => element._id == _id);
        if(!imagen_quitar) throw new Error("No se encontró una imagen seleccionada con id " + _id);
        let index = imagenes_pre_seleccionadas.findIndex( element => element._id == _id);
        imagenes_pre_seleccionadas.splice(index, 1);
        this.renderImagenesPreSeleccionadas(imagenes_pre_seleccionadas);
    }

    filtrarImagenes(valor){
        let valor_buscar = valor.toLowerCase();
        if(valor_buscar.length == 0){
            this.renderSelectorImagenes(JSON_IMAGENES_SELECTOR);
        }
        else{
            let valores_filtrados = [];
            for(let imagen of JSON_IMAGENES_SELECTOR){
                let nombre_img = imagen.name.toLowerCase();
                if(nombre_img.includes(valor_buscar)) valores_filtrados.push(imagen);
            }
            this.renderSelectorImagenes(valores_filtrados);
        }
    }
}
// fin selecetor de imágenes

// formulario validaciones
function checkInput(valor, caso){
    let status_input = null;
    switch(caso) {
        case 'nombreprod':
            status_input = ValidadorForm.validarNombre(valor);
            if(status_input.valid){
                VALID_STATUS.nombreprod = true;
                input_nombreprod.classList.remove("is-invalid");
                msgNombre.innerHTML = '';
            }
            else{
                VALID_STATUS.nombreprod = false;
                input_nombreprod.classList.add("is-invalid");
                msgNombre.innerHTML = status_input.msg;
            }
        break;
        case "art":
            status_input = ValidadorForm.validarNumero(valor);
            if(status_input.valid){
                VALID_STATUS.nro_art = true;
                input_nro_art.classList.remove("is-invalid");
                msgNroArt.innerHTML = '';
            }
            else{
                VALID_STATUS.nro_art = false;
                input_nro_art.classList.add("is-invalid");
                msgNroArt.innerHTML = status_input.msg;
            }
        break;
        case "orden":
            console.log(valor);
            status_input = ValidadorForm.validarNumero(valor);
            if(status_input.valid){
                VALID_STATUS.orden = true;
                input_orden.classList.remove('is-invalid');
                msgOrden.innerHTML = "";
            }
            else{
                VALID_STATUS.orden = false;
                input_orden.classList.add('is-invalid');
                msgOrden.innerHTML = status_input.msg;
            }
        break;
        case "precio":
            status_input = ValidadorForm.validarValorPrecio(valor);
            if(status_input.valid){
                VALID_STATUS.precio = true;
                input_precio.classList.remove('is-invalid');
                msgPrecio.innerHTML = "";
            }
            else{
                VALID_STATUS.precio = false;
                input_precio.classList.add('is-invalid');
                msgPrecio.innerHTML = status_input.msg;
            }
        break;
        case "precio_unit":
            status_input = ValidadorForm.validarValorPrecio(valor);
            if(status_input.valid){
                VALID_STATUS.precio_unit = true;
                input_precio_unitario.classList.remove('is-invalid');
                msgPrecioUnitario.innerHTML = "";
            }
            else{
                VALID_STATUS.precio_unit = false;
                input_precio_unitario.classList.add('is-invalid');
                msgPrecioUnitario.innerHTML = status_input.msg;
            }
        break;
        case "talles":
            let talles_seleccionados = 0;
            for(let check of talles_selector){
                if(check.checked) talles_seleccionados ++;
            }

            if(talles_seleccionados == 0){
                VALID_STATUS.talles = false;
                msgTalles.innerHTML = `<i class="bi bi-exclamation-circle"></i> Debe seleccionar al menos un talle!`;
            }
            else{
                VALID_STATUS.talles = true;
                msgTalles.innerHTML = ``;
            }
        break;
        case "descri_c":
            status_input = ValidadorForm.validarString(valor, 1, 1000, ValidadorForm.regWlString);
            if(status_input.valid){
                VALID_STATUS.descri_c = true;
                input_descri_c.classList.remove("is-invalid");
                msgDescriC.innerHTML = ''
            }
            else{
                VALID_STATUS.descri_c = false;
                input_descri_c.classList.add("is-invalid");
                msgDescriC.innerHTML = status_input.msg;
            }
        break;
        case "categorias":
            let categorias_selector = document.getElementsByClassName('categ_selector');
            let categs_seleccionados = 0;
            for(let categ_selector of categorias_selector){
                if(categ_selector.checked) categs_seleccionados ++;
            }
            if(categs_seleccionados == 0){
                VALID_STATUS.categorias = false;
                msgCategorias.innerHTML = '<i class="bi bi-exclamation-circle"></i> Debe seleccionar al menos una categoría!';
            }
            else{
                VALID_STATUS.categorias = true;
                msgCategorias.innerHTML = '';
            }
        break;
        default:
            break;
    }
}
// fin formulario de validaciones

function realizarSubmit(){
    json_input_imagenes_prod.value = JSON.stringify(imagenes_pre_seleccionadas);
    button_submit.setAttribute('disabled', '');
    button_submit.innerHTML = `${ValidadorForm.spinnerSmHtml()} Cargando...`;
    form_producto.submit();
}

button_selector_img.addEventListener('click', e => $("#modalSelectorDeImagenes").modal('show'));
input_search_img.addEventListener('keyup', e  => SelectorIMGController.filtrarImagenes(e.target.value));
input_nombreprod.addEventListener('change', e => checkInput(e.target.value, 'nombreprod'));
input_nro_art.addEventListener('change', e => checkInput(e.target.value, 'art'));
input_orden.addEventListener('change', e => checkInput(e.target.value, 'orden'));
input_precio.addEventListener('change', e => checkInput(e.target.value, 'precio'));
input_precio_unitario.addEventListener('change', e => checkInput(e.target.value, 'precio_unit'));
input_descri_c.addEventListener('change', e => checkInput(e.target.value, 'descri_c'));
input_descri_c.addEventListener('keyup', e => {count_chars_descri_c.innerHTML = e.target.value.length});
form_producto.addEventListener('submit', e => {
    e.preventDefault();
    checkInput(input_nombreprod.value, 'nombreprod');
    checkInput(input_nro_art.value, 'art');
    checkInput(input_orden.value, 'orden');
    checkInput(input_precio.value, 'precio');
    checkInput(input_precio_unitario.value, 'precio_unit');
    checkInput("", "talles");
    checkInput(input_descri_c.value, 'descri_c');
    checkInput('', 'categorias');
    if(VALID_STATUS.nombreprod && VALID_STATUS.categorias && VALID_STATUS.descri_c && VALID_STATUS.nro_art && VALID_STATUS.orden && VALID_STATUS.precio && VALID_STATUS.precio_unit && VALID_STATUS.talles){
        if(imagenes_pre_seleccionadas.length == 0){
            Swal.fire({
                title: "Atención!",
                html: `No ha seleccionado ninguna imagen para este producto. ¿Continuar de todas formas?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#FFC107",
                cancelButtonColor: "#373A3C",
                confirmButtonText: "Continuar",
                cancelButtonText : "Cancelar",
                toast : true
            }).then((result) => {
                if(result.isConfirmed) {
                    realizarSubmit();
                }
            });
        }
        else{
            realizarSubmit();
        }
    }
})
document.addEventListener('DOMContentLoaded', e => {
    SelectorIMGController = new ImagenesHandler();
    ValidadorForm = new Validador();
    SelectorIMGController.renderSelectorImagenes(JSON_IMAGENES_SELECTOR);

    $('#input_descri_l').trumbowyg({
        lang: 'es',
        btns: [
            ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em', 'del'],
            ['foreColor', 'backColor'],
            ['superscript', 'subscript'],
            ['link'],
            ['insertImage'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen'],
            ['emoji']
        ],
        imageWidthModalEdit: true,
        plugins: {
            resizimg: {
                minSize: 64,
                step: 16,
            }
        }
    });
    if(PREV_IMAGENES != null){
        if(PREV_IMAGENES.length > 0){
            imagenes_pre_seleccionadas = [...PREV_IMAGENES];
            SelectorIMGController.renderImagenesPreSeleccionadas(imagenes_pre_seleccionadas);
        }
    }
})