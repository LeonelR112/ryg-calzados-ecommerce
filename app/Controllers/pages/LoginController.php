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
            $Sed = new SED;
            $LoginModel = new LoginModel;
            $datos = [
                "nombre" => htmlspecialchars(addslashes($_POST['nombre'])),
                "email" => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                "telefono" => (int) filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT) == 0 ? "" : filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT),
                "contrasena" => htmlspecialchars(addslashes($_POST['contrasena'])),
                "mensaje_solicitud" => htmlspecialchars(addslashes($_POST['mensaje'])),
                "creado_en" => current_date()->format("Y-m-d"),
                "actualizado_en" => current_date()->format("Y-m-d"),
                "verificado" => "N",
                "categoria" => 4,
                "estado" => "I"
            ];

            $existe_registro = $LoginModel->getRegistroExistente($datos['email']);
            if($existe_registro){
                $datos_noti = [
                    "icon" => "warning",
                    "title" => "Atención!",
                    "html" => "El email <b>". $datos['email'] ."</b> ya se encuentra registrado en el sistema. Intente con otro email. También puede solicitar la recuperación de la contraseña, siempre y cuando la cuenta esté habilitada."
                ];
                $_SESSION['prevData'] = $datos;
                redirectWithNotification($datos_noti, "registrarse");
            }

            ########################
            ## Validar datos aquí ##
            ########################

            $datos['contrasena'] = $Sed->encryption($datos['contrasena']);
            $registro_creado = $LoginModel->addRegistroSolicitud($datos);
            $creado = false;
            $registro_creado ? $creado = true : $creado = false;

            view("pages.login.respuestaFinalRegistro", [
                "creado" => $creado,
                "registro_creado" => $registro_creado
            ]);
        }
    }
?>