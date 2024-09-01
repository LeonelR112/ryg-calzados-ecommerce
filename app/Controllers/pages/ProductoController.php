<?php
    class ProductoController{
        static function renderIndex(){
            $ProductoModel = new ProductoModel;
            $categorias = $ProductoModel->getAllCategoriasVisibles();

            $json_categorias = json_encode($categorias, JSON_INVALID_UTF8_IGNORE);
            view("pages.productos.index", [
                "json_categorias" => $json_categorias
            ]);
        }
    }
?>