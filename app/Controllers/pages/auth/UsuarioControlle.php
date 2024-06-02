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

        static function crearNuevoUsuario(){
            $UsuarioModel = new UsuarioModel;
            $datos = [
                "nombre" => htmlspecialchars(addslashes($_POST['nombre'])),
                "email" => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                "contrasena" => addslashes($_POST['contrasena']),
                "telefono" => (int) filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT),
                "categoria" => (int) filter_var($_POST['categoria'], FILTER_SANITIZE_NUMBER_INT),
                "estado" => htmlspecialchars(addslashes($_POST['estado'])),
                "verificado" => htmlspecialchars(addslashes($_POST['verificado'])),
                "enviar_notificación" => isset($_POST['enviar_notificacion']) ? (int)filter_var($_POST['enviar_notificacion'], FILTER_SANITIZE_NUMBER_INT) : 0,
                "creado_en" => current_date()->format("Y-m-d"),
                "actualizado_en" => current_date()->format("Y-m-d"),
                "mensaje_solicitud" => ''
            ];

            ### Validar aquÍ ###

            if($UsuarioModel->addUsuario($datos)){
                $datos_noti = [
                    "tipo" => "success",
                    "title" => "Registro guardado",
                    "msg" => "Se ha creado el usuario <b>". $datos['nombre'] ."</b> correctamente.",
                    "time" => 5000
                ];
                redirectWitchToast("auth/usuarios", $datos_noti);
            }   
            else{
                $datos_noti = [
                    "tipo" => "danger",
                    "title" => "Error",
                    "msg" => "Ha ocurrido un error al intentar guardar los datos, intente nuevamente.",
                    "time" => 5000
                ];
                redirectWitchToast("auth/usuarios/nuevo-usuario", $datos_noti);
            }
        }
    }
 ?>