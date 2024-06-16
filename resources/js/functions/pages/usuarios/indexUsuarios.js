let input_search = document.getElementById('input_search');
let tbody_usuarios_usuarios = document.getElementById('tbody_usuarios');
let form_delete = document.getElementById('form_delete');
let input_del_id_usario = document.getElementById('input_del_id_usario');

function renderTablaUsuarios(array_usuarios){
    if(array_usuarios.length == 0){
        $("#paginador").html("");
        tbody_usuarios.innerHTML = `
            <tr>
                <td class="text-muted" colspan="9">No se encontraron usuarios...</td>
            </tr>
        `;
    }
    else if(array_usuarios.length <= 20){
        $("#paginador").html("");
        tbody_usuarios.innerHTML = ``;
        let output = obtenerFilasDeLaTabla(array_usuarios);
        $(tbody_usuarios).append(output);
    }
    else{
        $('#paginador').pagination({
            dataSource: array_usuarios,
            pageSize: 20,
            callback: function(data, pagination) {
                tbody_usuarios.innerHTML = ``;
                let output = obtenerFilasDeLaTabla(data);
                $(tbody_usuarios).append(output);
            }
        })
    }
}

function obtenerFilasDeLaTabla(array_usuarios){
    let output_html = ``;
    for(let usuario of array_usuarios){
        output_html += `
            <tr>
                <td>${usuario.id_usuario}</td>
                <td>${usuario.nombre}</td>
                <td>${usuario.email}</td>
                <td>${usuario.telefono == 0 ? `<span class="small text-muted fst-italic" title="Este usuario no incluyó su teléfono">- No especifica -</span>` : usuario.telefono}</td>
                <td>${obtenerCategoriaSpan(usuario.categoria)}</td>
                <td>${usuario.creado_en.split("-").reverse().join("/")}</td>
                <td>${usuario.estado == 'A' ? 'Activo' : 'Inactivo'}</td>
                <td class="text-center">${usuario.verificado == 'S' ? `<i class="bi bi-check-circle-fill text-success fs-3" title="Este usuario fue verificado"></i>` : `<i class="bi bi-x-circle-fill text-danger fs-3" title="Este usuario no fue verificado aún"></i>`}</td>
                <td class="text-end">
                    <button class="btn btn-info btn-sm" tupe="button" onclick="verDetallesDeUnUsuario('${usuario.id_usuario}')" title="Ver con más detalles"><i class="bi bi-list-task"></i></button>
                    <a class="btn btn-primary btn-sm" href="${MAIN_URL}usuarios/editar/${usuario.id_usuario}" title="Editar"><i class="bi bi-pencil"></i></a>
                    <button class="btn btn-danger btn-sm" type="button" id="button_del_${usuario.id_usuario}" onclick="borrarUsuario('${usuario.id_usuario}')" title="Borrar usuario"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
        `;
    }
    return output_html;
}

function verDetallesDeUnUsuario(id_usuario){
    let usuario = JSON_USUARIOS.find( element => element.id_usuario == id_usuario);
    if(!usuario) throw new Error("No se encontró un usuario con id " + id_usuario);
    let output_html = `
        <section class="row m-0 g-2">
            <div class="col-12 col-md-6 mb-3">
                <ul class="list-group list-group-flush text-start">
                    <li class="list-group-item"><span class="text-muted">ID: </span>${usuario.id_usuario}</li>
                    <li class="list-group-item"><span class="text-muted">Nombre: </span>${usuario.nombre}</li>
                    <li class="list-group-item"><span class="text-muted">Email: </span>${usuario.email}</li>
                    <li class="list-group-item"><span class="text-muted">Teléfono: </span>${usuario.telefono != 0 ? usuario.telefono :  `<span class="text-muted fst-italic small">- No especificó -</span>`}</li>
                </ul>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <ul class="list-group list-group-flush text-start">
                    <li class="list-group-item"><span class="text-muted">Categoría: </span>${obtenerCategoriaSpan(usuario.categoria)}</li>
                    <li class="list-group-item"><span class="text-muted">Registrado en: </span>${usuario.creado_en.split("-").reverse().join("/")}</li>
                    <li class="list-group-item"><span class="text-muted">Estado: </span>${usuario.estado == 'A' ? `<span class="badge bg-success">Activo</span>` : `<span class="badge bg-dark">Inactivo</span>`}</li>
                    <li class="list-group-item"><span class="text-muted">Verificado: </span>${usuario.verificado == 'S' ? `<i class="bi bi-check2-circle text-success" title="Este usuario está verificado"></i>` : `<i class="bi bi-x-circle text-danger" title="Este usuario no está verificado aún"></i>`}</li>
                </ul>
            </div>
            <div class="col-12">
                <p class="text-muted m-0">Mensaje de solicitud:</p>
                <div class="p-2 border m-1 fst-italic">
                    ${usuario.mensaje_solicitud}
                </div>
            </div>
        </section>
    `;

    Swal.fire({
        icon : "info",
        title : "Más información",
        html : output_html,
        width : "50rem",
        confirmButtonText : "Cerrar"
    });
}

function borrarUsuario(id_usuario){
    let usuario = JSON_USUARIOS.find( element => element.id_usuario == id_usuario);
    if(!usuario) throw new Error("No se encontró un usuario con id " + id_usuario);
    Swal.fire({
        title: "¿Borrar usuario?",
        html: `Está a punto de eliminar al usuario <b>${usuario.nombre}</b> del sistema. Si este usuario tiene registro como cliente, todos sus datos también serán elminados. <p class="text-center">Confirmar borrado:</p>`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si, borrar",
        cancelButtonText : "Cancelar"
    }).then((result) => {
        if(result.isConfirmed) {
            let button_del = document.getElementById(`button_del_${id_usuario}`);
            button_del.setAttribute('disabled', '');
            button_del.innerHTML = `
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            `;
            input_del_id_usario.value = parseInt(usuario.id_usuario);
            form_delete.submit();
        }
    });
}

function obtenerCategoriaSpan(nro_categoria){
    if(nro_categoria == 1){
        return `<span class="badge bg-primary" title="Administrador">Administrador</span>`
    }
    else if(nro_categoria == 4){
        return `<span class="badge bg-secondary">Miembro</span>`
    }
    else{
        return `Desconocido`
    }
}

function filtrarUsuarios(valor){
    let valor_buscar = valor.toLowerCase();
    if(valor_buscar.length == 0){
        renderTablaUsuarios(JSON_USUARIOS);
    }
    else{
        let valores_filtrados = [];
        for(let usuario of JSON_USUARIOS){
            let nombre = usuario.nombre.toLowerCase();
            let email = usuario.email.toLowerCase();
            if(nombre.indexOf(valor_buscar) != -1 || email.indexOf(valor_buscar) != -1) valores_filtrados.push(usuario);
        }
        renderTablaUsuarios(valores_filtrados);
    }
}

input_search.addEventListener('keyup', e => filtrarUsuarios(e.target.value));
document.addEventListener('DOMContentLoaded', e => {
    renderTablaUsuarios(JSON_USUARIOS);
})