<?php
    class CategoriaController{
        private const URL_MEDIA = "public/media/productos/";

        static function renderIndex(){
            $CategoriaModel = new CategoriaModel;
            $categorias = $CategoriaModel->getAllCategorias();

            $json_categorias = json_encode($categorias, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.productos.categorias.indexCategorias", [
                "json_categorias" => $json_categorias
            ]);
        }

        static function formNuevaCategoria(){
            $lista_imagenes = getImagesFromMediaFolder("productos");
            $imagenes_ordenadas = getImagesListTidy($lista_imagenes, self::URL_MEDIA);
            
            $json_imagenes = json_encode($imagenes_ordenadas, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.productos.categorias.formNuevaCategoria", [
                "json_imagenes" => $json_imagenes
            ]);
        }

        static function guardarNuevaCategoria(){
            $CategoriaModel = new CategoriaModel;
            $datos = [
                "nombrecat" => htmlspecialchars(addslashes($_POST['nombrecat'])),
                "orden" => floatval($_POST['orden']),
                "descri_c" => htmlspecialchars(addslashes($_POST['descri_c'])),
                "descri_l" => $_POST['descri_l'],
                "imagen" => htmlspecialchars($_POST['imagen']),
                "visible" => htmlspecialchars(addslashes($_POST['visible'])),
                "color" => htmlspecialchars($_POST['color'])
            ];
            if($CategoriaModel->addCategoria($datos)){
                redirectWitchToast("auth/productos/categorias", [
                    "tipo" => "success",
                    "title" => "Guardado",
                    "msg" => "La categoría <b>". $datos['nombrecat'] ."</b> fue guardad correctamente.",
                    "time" => 5000
                ]);
            }
            else{
                redirectWitchToast("auth/productos/categorias", [
                    "tipo" => "error",
                    "title" => "Error",
                    "msg" => "Ha ocurrido un error al intentar guardar la categoría. Intente nuevamente.",
                    "time" => 5000
                ]);
            }
        }
    }
?>