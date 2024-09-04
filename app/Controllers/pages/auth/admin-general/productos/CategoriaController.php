<?php
    class CategoriaController{
        private const URL_MEDIA = "public/media/productos/";

        static function renderIndex(){
            $CategoriaModel = new CategoriaModel;
            $categorias = $CategoriaModel->getAllCategorias();

            $json_categorias = json_encode($categorias, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.adm-general.productos.categorias.indexCategorias", [
                "json_categorias" => $json_categorias
            ]);
        }

        static function formNuevaCategoria(){
            $lista_imagenes = getImagesFromMediaFolder("productos");
            $imagenes_ordenadas = getImagesListTidy($lista_imagenes, self::URL_MEDIA);
            
            $json_imagenes = json_encode($imagenes_ordenadas, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.adm-general.productos.categorias.formNuevaCategoria", [
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
                    "msg" => "La categoría <b>". $datos['nombrecat'] ."</b> fue guardada correctamente.",
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

        static function formModificarCategoria($id){
            $CategoriaModel = new CategoriaModel;
            $id_categ = (int) filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $categoria = $CategoriaModel->getCategoria($id_categ);
            if(!$categoria) redirectTo("not-found");
            $lista_imagenes = getImagesFromMediaFolder("productos");
            $imagenes_ordenadas = getImagesListTidy($lista_imagenes, self::URL_MEDIA);

            $json_imagenes = json_encode($imagenes_ordenadas, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.adm-general.productos.categorias.formModificarCategoria", [
                "categoria" => $categoria,
                "json_imagenes" => $json_imagenes
            ]);
        }

        static function actualizarCategoria(){
            $CategoriaModel = new CategoriaModel;
            $datos = [
                "id_categ" => (int) filter_var($_POST['id_categ'], FILTER_SANITIZE_NUMBER_INT),
                "nombrecat" => htmlspecialchars(addslashes($_POST['nombrecat'])),
                "orden" => floatval($_POST['orden']),
                "descri_c" => htmlspecialchars(addslashes($_POST['descri_c'])),
                "descri_l" => $_POST['descri_l'],
                "imagen" => htmlspecialchars($_POST['imagen']),
                "visible" => htmlspecialchars(addslashes($_POST['visible'])),
                "color" => htmlspecialchars($_POST['color'])
            ];
            $categoria = $CategoriaModel->getCategoria($datos['id_categ']);
            if(!$categoria) redirectTo("not-found");
            if($CategoriaModel->updateCategoria($datos)){
                redirectWitchToast("auth/productos/categorias", [
                    "tipo" => "success",
                    "title" => "Guardado",
                    "msg" => "La categoría <b>". $datos['nombrecat'] ."</b> fue actualizada correctamente.",
                    "time" => 5000
                ]);
            }
            else{
                redirectWitchToast("auth/productos/categorias", [
                    "tipo" => "error",
                    "title" => "Error",
                    "msg" => "Ha ocurrido un error al intentar actualizar la categoría. Intente nuevamente.",
                    "time" => 5000
                ]);
            }
        }

        static function borrarCategoria(){
            $CategoriaModel = new CategoriaModel;
            $id_categ = (int) filter_var($_POST['id_categ'], FILTER_SANITIZE_NUMBER_INT);
            $categoria = $CategoriaModel->getCategoria($id_categ);
            if(!$categoria) redirectTo("not-found");
            if($CategoriaModel->deleteCategoria($id_categ)){
                redirectWitchToast("auth/productos/categorias", [
                    "tipo" => "success",
                    "title" => "Guardado",
                    "msg" => "La categoría <b>". $categoria['nombrecat'] ."</b> fue eliminada correctamente.",
                    "time" => 5000
                ]);
            }
            else{
                redirectWitchToast("auth/productos/categorias", [
                    "tipo" => "error",
                    "title" => "Error",
                    "msg" => "Ha ocurrido un error al intentar eliminar la categoría. Intente nuevamente.",
                    "time" => 5000
                ]);
            }
        }
    }
?>