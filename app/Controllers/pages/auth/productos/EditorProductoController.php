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
                "ids_categ" => $_POST['ids_categ'],
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
            
            // Guardar categorías
            if(!$EditorProductoModel->addCategoriasDeUnProducto($datos['ids_categ'], (int) $producto_creado->getId_producto())){
                if(!$EditorProductoModel->deleteProducto($producto_creado->getId_producto())) Logger::warning("Falló eliminado de producto post error al guardar categorías.");
                redirectWitchToast("auth/productos/editor-productos", [
                    "tipo" => "danger",
                    "title" => "Error!",
                    "msg" => "Ha ocurrido un problema al intentar guardar las categorías del producto, por ende el producto tampoco fue guardado. Si el problema persiste, se requiere revisión de la applicación web.",
                    "time" => 8000
                ]);
                exit;
            }
            // fin guardar categorías
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

        function formEditarProducto($id){
            $EditorProductoModel = new EditorProductoModel;
            $id_producto = (int) filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $producto = $EditorProductoModel->getProducto($id_producto);
            if(!$producto) redirectTo("not-found");
            $categorias_selector = $EditorProductoModel->getAllCategoriasSelector();
            $categorias_asignadas = $EditorProductoModel->getAllCategoriasAsignadasEnUnProducto($id_producto);
            $pre_imagenes_asignadas = $EditorProductoModel->getAllImagenesDeUnProducto($id_producto);
            $talles_asignados_array = explode(",", $producto['talles']);
            $imagenes_asignadas = [];

            foreach ($pre_imagenes_asignadas as $img){
                $url_splitted = explode("/", $img['url_img']);
                $nombre_archivo = end($url_splitted);
                $pre_datos = [
                    "_id" => generateRandomString(30),
                    "name" => $nombre_archivo,
                    "url_image" => $img['url_img'],
                    "principal" => $img['principal']
                ];
                $imagenes_asignadas[] = $pre_datos;
            }
            
            $pre_imagenes = getImagesFromMediaFolder("productos");
            $imagenes_selector = getImagesListTidy($pre_imagenes, "public/media/productos/");

            $json_imagenes_selector = json_encode($imagenes_selector, JSON_INVALID_UTF8_IGNORE);
            $json_imagenes_asignadas = json_encode($imagenes_asignadas, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.productos.editorProductos.formModificarProducto", [
                "producto" => $producto,
                "categorias" => $categorias_selector,
                "json_imagenes_selector" => $json_imagenes_selector,
                "json_imagenes_asignadas" => $json_imagenes_asignadas,
                "talles_asignados_array" => $talles_asignados_array,
                "categorias_asignadas" => $categorias_asignadas
            ]);
        }

        function actualizarProducto(){
            $EditorProductoModel = new EditorProductoModel;
            $datos = [
                "id_producto" => (int) filter_var($_POST['id_producto'], FILTER_SANITIZE_NUMBER_INT),
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
                "ids_categ" => $_POST['ids_categ'],
                "tags" => ""
            ];
            $imagenes_producto = json_decode($_POST['json_imagenes_prod'], JSON_INVALID_UTF8_IGNORE);

            // Actualizar las categorías asignadas del producto
            if(!$EditorProductoModel->deleteCategoriasAsignadas($datos['id_producto'])){
                // Falló borrado de categorías antiguas
                die;
                Logger::warning("Falló actualizar categorías de un producto", "id_producto = " . $datos['id_producto']);
                redirectWitchToast("auth/productos/editor-productos", [
                    "tipo" => "danger",
                    "title" => "Error!",
                    "msg" => "Ha ocurrido un problema al intentar actualizar las categorías del producto, por ende el producto tampoco fue actualizado. Si el problema persiste, se requiere revisión de la applicación web.",
                    "time" => 8000
                ]);
                exit;
            }
            if(!$EditorProductoModel->addCategoriasDeUnProducto($datos['ids_categ'], $datos['id_producto'])){
                // Falló guardado de categorías
                die;
                Logger::warning("Falló actualizar categorías de un producto", "id_producto = " . $datos['id_producto']);
                redirectWitchToast("auth/productos/editor-productos", [
                    "tipo" => "danger",
                    "title" => "Error!",
                    "msg" => "Ha ocurrido un problema al intentar actualizar las categorías del producto, por ende el producto tampoco fue actualizado. Si el problema persiste, se requiere revisión de la applicación web.",
                    "time" => 8000
                ]);
                exit;
            }
            // Fin actualización de las categorías
            // Actualizar imágenes
            if(!$EditorProductoModel->deleteImagenesAsignadas($datos['id_producto'])) Logger::error("Falló borrar imágenes asignadas en un producto en ABM productos", "id_producto = " . $datos['id_producto']);
            if(!$EditorProductoModel->guardarImagenesDeUnProducto($datos['id_producto'], $imagenes_producto)){
                redirectWitchToast("auth/productos/editor-productos", [
                    "tipo" => "danger",
                    "title" => "Error!",
                    "msg" => "Ha ocurrido un problema al intentar guardar las imágenes del producto, por ende el producto tampoco fue guardado. Si el problema persiste, se requiere revisión de la applicación web.",
                    "time" => 8000
                ]);
                exit;
            }
            // fin actualizar imágenes

            if($EditorProductoModel->updateProducto($datos)){
                redirectWitchToast( "auth/productos/editor-productos", [
                    "tipo" => "success",
                    "title" => "Actualizado!",
                    "msg" => "El producto <b>". $datos['nombreprod'] ."</b> fue creado actualizado correctamente.",
                    "time" => 8000
                ]);
                exit;
            }
            else{
                redirectWitchToast("auth/productos/editor-productos", [
                    "tipo" => "danger",
                    "title" => "Error!",
                    "msg" => "Ha ocurrido un problema al intentar actualizar el producto. Más info en Logs.",
                    "time" => 8000
                ]);
                exit;
            }
        }
    }
?>