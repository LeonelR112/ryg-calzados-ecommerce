<?php
    class EditorProductoController{
        static function renderIndex(){

            view("pages.auth.productos.editorProductos.indexEditorDeProductos", []);
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
    }
?>