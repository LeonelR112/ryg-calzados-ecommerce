<?php
    class CatalogoPublicoController{
        static function renderIndex(){
            $CatalogoPublicoModel = new CatalogoPublicoModel;
            $categorias = $CatalogoPublicoModel->getAllCategoriasVisibles();

            $json_categorias = json_encode($categorias, JSON_INVALID_UTF8_IGNORE);
            view("pages.catalogo.index", [
                "categorias" => $categorias,
                "json_categorias" => $json_categorias
            ]);
        }

        static function verProductosDeUnaCategoria($id){    
            $CatalogoPublicoModel = new CatalogoPublicoModel;
            $id_categ = (int) filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $categoria = $CatalogoPublicoModel->getDetallesDeLaCategoria($id_categ);
            if(!$categoria) redirectTo("not-found");
            $productos = $CatalogoPublicoModel->getAllProductosDeUnaCategoria($id_categ);
            
            $json_productos = json_encode($productos, JSON_INVALID_UTF8_IGNORE);
            view("pages.catalogo.productosEnElCatalogo", [
                "categoria" => $categoria,
                "json_productos" => $json_productos
            ]);
        }

        static function verDetallesDeUnProducto($id){
            $CatalogoPublicoModel = new CatalogoPublicoModel;
            $id_producto = (int) filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $producto = $CatalogoPublicoModel->getProductoDetalles($id_producto);
            if(!$producto) redirectTo("not-found");
            $imagenes_producto = $CatalogoPublicoModel->getImagenesDeUnProducto($id_producto);

            view("pages.catalogo.detallesDeUnProducto", [
                "producto" => $producto,
                "imagenes_producto" => $imagenes_producto
            ]);
        }
    }
?>