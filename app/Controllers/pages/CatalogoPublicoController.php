<?php
    class CatalogoPublicoController{
        static function renderIndex(){
            $CatalogoPublicoModel = new CatalogoPublicoModel;
            $categorias = $CatalogoPublicoModel->getAllCategoriasVisibles();

            $json_categorias = json_encode($categorias, JSON_INVALID_UTF8_IGNORE);
            view("pages.productos.index", [
                "categorias" => $categorias,
                "json_categorias" => $json_categorias
            ]);
        }
    }
?>