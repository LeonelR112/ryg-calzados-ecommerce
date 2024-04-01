<?php
    class ProductoController{
        static function renderIndex(){
            $ProductoModel = new ProductoModel;
            $productos = $ProductoModel->getAllProductos();

            view("pages.productos.index", [
                "productos" => $productos
            ]);
        }
    }
?>