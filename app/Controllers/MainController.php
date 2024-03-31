<?php
    class MainController{
        static function renderIndex(){
            view("homepage.index", [
                "titulo" => "Página principal"
            ]);
        }
    }
?>