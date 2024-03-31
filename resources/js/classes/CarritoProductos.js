class CarritoProductos {
    constructor(clave){
        this.clave = clave || "cart";
        this.productos = this.obtener();
    }

    //Funciones de acción del carrito
    agregar(producto) {
        if (!this.existe(producto.id_producto)) {
            this.productos.push(producto);
            this.guardar();
        }
        else{
            let producto_existe = this.existe(producto.id_producto);
            producto_existe.cantidad = parseInt(producto_existe.cantidad) + parseInt(producto.cantidad);
            this.guardar();
        }
    }

    actualizar(id){
        let producto = this.existe(id);
        this.guardar(producto);
    }

    quitar(id_producto) {
        const indice = this.productos.findIndex(p => p.id_producto == id_producto);
        if (indice != -1) {
            this.productos.splice(indice, 1);
            this.guardar();
        }
    }

    guardar() {
        sessionStorage.setItem(this.clave, JSON.stringify(this.productos));
    }

    obtener() {
        const productosCodificados = sessionStorage.getItem(this.clave);
        return JSON.parse(productosCodificados) || [];
    }

    existe(id) {
        return this.productos.find(producto => producto.id_producto == id);
    }

    obtenerConteo() {
        return this.productos.length;
    }

    obtenerConteoDeTodosLosProductos(){
        let productos = this.productos;
        let conteoGeneral = 0;
        if(productos){
            for(let producto of productos){
                conteoGeneral += parseInt(producto.cantidad);
            }
            return conteoGeneral;
        }
        else{
            return conteoGeneral;
        }
    }

    obtenerCantidadTotalDeUnProducto(id_producto){
        let productos_en_carrito = this.obtener();
        let producto_existe = productos_en_carrito.find( prod => prod.id_producto == id_producto);
        if(producto_existe){
            return producto_existe.cantidad
        }
        else{
            throw new Error("No se encontró el producto en el carrito");
        }
    }

    limpiarCarrito(){
        let clave = this.clave || "cart";
        sessionStorage.removeItem(clave);
    }

    //funciones de cantidad
    sumarCantidadMasUnoEnUnCampo(id_producto){
        
    }
}