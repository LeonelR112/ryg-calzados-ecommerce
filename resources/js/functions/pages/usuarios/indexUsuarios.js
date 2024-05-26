let input_search = document.getElementById('input_search');
let tbody_usuarios_usuarios = document.getElementById('tbody_usuarios');

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
                <td>${usuario.telefono === 0 ? usuario.telefono : `<span class="small text-muted fst-italic" title="Este usuario no incluyó su teléfono">- No especifica -</span>`}</td>
                <td>${obtenerCategoriaSpan(usuario.categoria)}</td>
                <td>${usuario.creado_en.split("-").reverse().join("/")}</td>
                <td>${usuario.estado == 'A' ? 'Activo' : 'Inactivo'}</td>
                <td class="text-center">${usuario.verificado == 'S' ? `<i class="bi bi-check-circle-fill text-success fs-3" title="Este usuario fue verificado"></i>` : `<i class="bi bi-x-circle-fill text-danger fs-3" title="Este usuario no fue verificado aún"></i>`}</td>
                <td class="text-end">
                    <a class="btn btn-info btn-sm" href="#" title="Ver con más detalles"><i class="bi bi-list-task"></i></a>
                    <a class="btn btn-primary btn-sm" href="#" title="Editar"><i class="bi bi-pencil"></i></a>
                    <button class="btn btn-danger btn-sm" type="button" title="Borrar usuario"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
        `;
    }
    return output_html;
}

function obtenerCategoriaSpan(nro_categoria){
    if(nro_categoria == 1){
        return `<span class="badge bg-primary" title="Administrador">Administrador</span>`
    }
    else if(nro_categoria == 4){
        return `<span class="badge bg-secodary">Miembro</span>`
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