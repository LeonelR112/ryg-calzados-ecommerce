<?php
    class ImagenesController{
        private const DIR_MEDIA = __DIR__ . "/../../../../../public/media/productos/";
        private const URL_MEDIA = "public/media/productos/";

        static function renderIndex(){
            $lista_imagenes = getImagesFromMediaFolder("productos");
            $imagenes_ordenadas = getImagesListTidy($lista_imagenes, self::URL_MEDIA);
            
            $json_imagenes = json_encode($imagenes_ordenadas, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.productos.gestorImagenes.indexImagenes", [
                "json_imagenes" => $json_imagenes
            ]);
        }
    }
?>