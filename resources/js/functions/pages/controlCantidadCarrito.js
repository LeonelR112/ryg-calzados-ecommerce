let inputs_control_cantidad = document.getElementsByClassName('input_cantidad_control');

function controlCantidad(action, id_producto){
    let input_cantidad = document.getElementById(`cant_prod_${id_producto}`);
    if(action == 'sumar'){
        input_cantidad.value = parseInt(input_cantidad.value) + 1
    }
    else if(action == 'restar'){
        if(parseInt(input_cantidad.value) > 1){
            input_cantidad.value = parseInt(input_cantidad.value) - 1
        }
    }
    else{
        throw new Error("Control input de cantidad no encontrado con id " + id_producto);
    }
}

document.addEventListener('DOMContentLoaded', e => {
    for(let input of inputs_control_cantidad){
        input.addEventListener('change', e => {
            if(e.target.value <= 0){
                e.target.value = 1
            }
        })
    }
})