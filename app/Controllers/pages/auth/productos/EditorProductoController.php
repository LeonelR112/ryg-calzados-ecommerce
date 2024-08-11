<?php
    class EditorProductoController{
        static function renderIndex(){
            $EditorProductoModel = new EditorProductoModel;
            $productos = $EditorProductoModel->getAllProductos();

            $json_productos = json_encode($productos, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.productos.editorProductos.indexEditorDeProductos", [
                "json_productos" => $json_productos
            ]);
        }

        static function formNuevoProducto(){
            $EditorProductoModel = new EditorProductoModel;
            $categorias_selector = $EditorProductoModel->getAllCategoriasSelector();
            $pre_imagenes = getImagesFromMediaFolder("productos");
            $imagenes_selector = getImagesListTidy($pre_imagenes, "public/media/productos/");

            $json_imagenes_selector = json_encode($imagenes_selector, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.productos.editorProductos.formNuevoProducto", [
                "categorias" => $categorias_selector,
                "json_imagenes_selector" => $json_imagenes_selector
            ]);
        }

        static function crearNuevoProducto(){
            $EditorProductoModel = new EditorProductoModel;
            $datos = [
                "nombreprod" => htmlspecialchars(addslashes($_POST['nombreprod'])),
                "nro_art" => (int) filter_var($_POST['nro_art'], FILTER_SANITIZE_NUMBER_INT),
                "orden" => floatval($_POST['orden']),
                "precio" => floatval($_POST['precio']),
                "precio_unitario" => floatval($_POST['precio_unitario']),
                "stock" => htmlspecialchars(addslashes($_POST['haystock'])),
                "visible" => htmlspecialchars(addslashes($_POST['visible'])),
                "descri_c" => htmlspecialchars(addslashes($_POST['descri_c'])),
                "descri_l" => $_POST['descri_l'],
                "talles" => implode(",", $_POST['talles']),
                "tags" => ""
            ];
            $imagenes_producto = json_decode($_POST['json_imagenes_prod'], JSON_INVALID_UTF8_IGNORE);

            // Crear producto
            $producto_creado = $EditorProductoModel->addProducto($datos);
            // fin crear producto
            if(!$producto_creado){
                redirectWitchToast("auth/productos/editor-productos", [
                    "tipo" => "danger",
                    "title" => "Error!",
                    "msg" => "Ha ocurrido un problema al intentar guardar el producto, intente nuevamente. Si el problema persiste, se requiere revisión de la applicación web.",
                    "time" => 8000
                ]);
                exit;
            }
            
            //Guardar Fotos
            if(!$EditorProductoModel->guardarImagenesDeUnProducto($producto_creado->getId_producto(),$imagenes_producto)){
                if(!$EditorProductoModel->deleteProducto($producto_creado->getId_producto())) Logger::warning("Falló eliminado de producto post error al guardar imágenes.");
                redirectWitchToast("auth/productos/editor-productos", [
                    "tipo" => "danger",
                    "title" => "Error!",
                    "msg" => "Ha ocurrido un problema al intentar guardar las imágenes del producto, por ende el producto tampoco fue guardado. Si el problema persiste, se requiere revisión de la applicación web.",
                    "time" => 8000
                ]);
                exit;
            }
            // Fin guardar Fotos

            redirectWitchToast( "auth/productos/editor-productos", [
                "tipo" => "success",
                "title" => "Guardado!",
                "msg" => "El producto <b>". $datos['nombreprod'] ."</b> fue creado correctamente.",
                "time" => 8000
            ]);
        }
    }
?>