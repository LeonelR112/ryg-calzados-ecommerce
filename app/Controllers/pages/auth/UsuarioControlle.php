<?php
    class UsuarioController{
        static function renderIndex(){
            $UsuarioModel = new UsuarioModel;
            $usuarios_registrados = $UsuarioModel->getAllUsuarios();

            $json_usuarios_registrados = json_encode($usuarios_registrados, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.usuarios.index", [
                "json_usuarios_registrados" => $json_usuarios_registrados
            ]);
        }

        static function formNuevoUsuario(){

            view("pages.auth.usuarios.formNuevoUsuario");
        }
    }
 ?>