<?php

use Random\Engine\Secure;

    class UsuarioController{
        static function renderIndex(){
            $UsuarioModel = new UsuarioModel;
            $usuarios_registrados = $UsuarioModel->getAllUsuarios();

            $json_usuarios_registrados = json_encode($usuarios_registrados, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.adm-general.usuarios.index", [
                "json_usuarios_registrados" => $json_usuarios_registrados
            ]);
        }

        static function formNuevoUsuario(){
            view("pages.auth.adm-general.usuarios.formNuevoUsuario");
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

        static function formModificarUsuario($id){
            $UsuarioModel = new UsuarioModel;
            $id_usuario = (int) filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $usuario_existe = $UsuarioModel->getUsuario($id_usuario);
            if(!$usuario_existe) redirectTo("not-found");
            $Sed = new SED;
            $contrasena_desencriptada = $Sed->decryption($usuario_existe['password']);
            $usuario_existe['password'] = $contrasena_desencriptada;
            
            view("pages.auth.adm-general.usuarios.formModificarUsuario", [
                "usuario_existe" => $usuario_existe
            ]);
        }

        static function modificarUsuario(){
            $UsuarioModel = new UsuarioModel;
            $datos = [
                "id_usuario" => (int) filter_var($_POST['id_usuario'], FILTER_SANITIZE_NUMBER_INT),
                "nombre" => htmlspecialchars(addslashes($_POST['nombre'])),
                "email" => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                "contrasena" => addslashes($_POST['contrasena']),
                "telefono" => (int) filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT),
                "categoria" => (int) filter_var($_POST['categoria'], FILTER_SANITIZE_NUMBER_INT),
                "estado" => htmlspecialchars(addslashes($_POST['estado'])),
                "verificado" => htmlspecialchars(addslashes($_POST['verificado'])),
                "enviar_notificación" => isset($_POST['enviar_notificacion']) ? (int)filter_var($_POST['enviar_notificacion'], FILTER_SANITIZE_NUMBER_INT) : 0,
                "actualizado_en" => current_date()->format("Y-m-d"),
                "mensaje_solicitud" => ''
            ];
            $Sed = new SED;
            $pass_encrypt = $Sed->encryption($datos['contrasena']);
            $datos['contrasena'] = $pass_encrypt;
            $usuario_existe = $UsuarioModel->getUsuario($datos['id_usuario']);
            if(!$usuario_existe) redirectTo("not-found");

            ### Validar aquÍ ###

            if($UsuarioModel->updateUsuario($datos)){
                $datos_noti = [
                    "tipo" => "success",
                    "title" => "Registro guardado",
                    "msg" => "Se ha actualizado el usuario <b>". $datos['nombre'] ."</b> correctamente.",
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
                redirectWitchToast("auth/usuarios/modificar-usuario/" . $datos['id_usuario'], $datos_noti);
            }
        }

        static function borrarUnUsuario(){
            $UsuarioModel = new UsuarioModel;
            $id_usuario = (int) filter_var($_POST['id_usuario'], FILTER_SANITIZE_NUMBER_INT);
            $usuario_existe = $UsuarioModel->getUsuario($id_usuario);  
            if($usuario_existe){
                if($UsuarioModel->deleteUsuario($id_usuario)){
                    $datos_noti = [
                        "tipo" => "success",
                        "title" => "Registro borrado",
                        "msg" => "Se ha eliminado el registro de <b>". $usuario_existe['nombre'] ."</b> de forma permanente.",
                        "time" => 8000
                    ];
                    redirectWitchToast("auth/usuarios", $datos_noti);
                }
                else{
                    $datos_noti = [
                        "tipo" => "danger",
                        "title" => "Error!",
                        "msg" => "Ha ocurrido un error al intentar borrar este registro, intente nuevamente. Si esto persiste, el programa necesita una revisión",
                        "time" => 8000
                    ];
                    redirectWitchToast("auth/usuarios", $datos_noti);
                }
            }
            else{
                $datos_noti = [
                    "tipo" => "danger",
                    "title" => "Error!",
                    "msg" => "No se ha encontrado el usuario con id " . $id_usuario . " en el sistema. Si esto es frecuente, por favor revise el programa.",
                    "time" => 8000
                ];
                redirectWitchToast("auth/usuarios", $datos_noti);
            }
        }
    }
 ?>