<?php
    class LoginController{
        static function renderIndex(){
            view("pages.login.indexLogin");
        }

        static function verificarUsuario(){
            ################################
            ## INCORPORAR TOKEN ANTI CSRF ##
            ################################
            $Sed = new SED;
            $LoginModel = new LoginModel;
            $datos = [
                "email" => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                "contrasena" => htmlspecialchars(addslashes($_POST['contrasena']))
            ];
            $registro_encontrado_con_este_email = $LoginModel->getRegistroPorEmail($datos['email']);
            if(!$registro_encontrado_con_este_email){
                $datos_noti = [
                    "icon" => "warning",
                    "title" => "Atención!",
                    "html" => "Email o contraseña incorrecta. Intente nuevamente."
                ];
                $_SESSION['prevData']['prevemail'] = $datos['email'];
                redirectWithNotification($datos_noti, "ingresar");
            }
            $datos['contrasena_encriptada'] = $Sed->encryption($datos['contrasena']);
            if($datos['contrasena_encriptada'] === $registro_encontrado_con_este_email['password']){
                // Usuario reconocido. Verificar si está habilitado
                if($registro_encontrado_con_este_email['estado'] == "A"){
                    // Usuario aceptado
                    $_SESSION['session_user'] = [
                        "id_usuario" => (int)$registro_encontrado_con_este_email['id_usuario'],
                        "nombre" => $registro_encontrado_con_este_email['nombre'],
                        "email" => $registro_encontrado_con_este_email['email'],
                        "categoria" => (int) $registro_encontrado_con_este_email['categoria'],
                        "estado" => $registro_encontrado_con_este_email['estado'],
                        "verificado" => $registro_encontrado_con_este_email['verificado'],
                        "sesion_iniciada" => current_date()->format("Y-m-d H:i:s")
                    ];
                    redirectTo("auth/dashboard");
                }
                else{
                    $datos_noti = [
                        "icon" => "warning",
                        "title" => "Atención!",
                        "html" => "Esta cuenta no se encuentra habilitada para usar por el momento. Deberás esperar hasta que un administrador la verifique y la active. Si esto te está llevando mucho tiempo, por favor, realiza un envío de mensaje de contacto <a href='". route("contacto") ."'>haciendo click aquí</a> para solicitar el estado de tu cuenta."
                    ];
                    redirectWithNotification($datos_noti, "ingresar");
                }
            }
            else{
                $datos_noti = [
                    "icon" => "warning",
                    "title" => "Atención!",
                    "html" => "Email o contraseña incorrecta. Intente nuevamente."
                ];
                $_SESSION['prevData']['prevemail'] = $datos['email'];
                redirectWithNotification($datos_noti, "ingresar");
            }
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

        static function cerrarSesion(){
            session_destroy();
            session_unset();
            gc_enable();
            redirectTo("ingresar");
        }
    }
?>