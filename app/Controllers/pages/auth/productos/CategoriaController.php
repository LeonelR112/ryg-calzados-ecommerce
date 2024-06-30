<?php
    class CategoriaController{
        private const URL_MEDIA = "public/media/productos/";

        static function renderIndex(){
            view("pages.auth.productos.categorias.indexCategorias");
        }

        static function formNuevaCategoria(){
            $lista_imagenes = getImagesFromMediaFolder("productos");
            $imagenes_ordenadas = getImagesListTidy($lista_imagenes, self::URL_MEDIA);
            
            $json_imagenes = json_encode($imagenes_ordenadas, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.productos.categorias.formNuevaCategoria", [
                "json_imagenes" => $json_imagenes
            ]);
        }
    }
?>