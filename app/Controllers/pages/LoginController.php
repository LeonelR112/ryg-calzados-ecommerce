<?php
    class LoginController{
        static function renderIndex(){
            view("pages.login.indexLogin");
        }

        static function verificarUsuario(){
            var_dump($_POST);
        }

        static function formularioRegistro(){
            view("pages.login.formularioDeRegistro");
        }

        static function verificarUnRegistro(){
            var_dump($_POST);
        }
    }
?>