<?php
    class ImagenesController{
        private const DIR_MEDIA = __DIR__ . "/../../../../../public/media/productos/";
        private const URL_MEDIA = "public/media/productos/";

        static function renderIndex(){
            $lista_imagenes = getImagesFromMediaFolder("productos");
            $imagenes_ordenadas = getImagesListTidy($lista_imagenes, self::URL_MEDIA);
            
            $json_imagenes = json_encode($imagenes_ordenadas, JSON_INVALID_UTF8_IGNORE);
            view("pages.auth.productos.gestorImagenes.indexImagenes", [
                "json_imagenes" => $json_imagenes,
                "route_media" => MAIN_URL . self::URL_MEDIA
            ]);
        }

        static function subirImagenes(){
            if(count($_FILES['files_ready']) == 0){
                $datos_noti = [
                    "tipo" => "danger",
                    "title" => "Error!",
                    "msg" => "Ha ocurrido un error: no se encontraron los archivos a subir. Intente nuevamente.",
                    "time" => 5000
                ];
                redirectWitchToast("auth/productos/imagenes", $datos_noti);
            }
            $files_uploaded_successfully = [];
            $files_error = [];

            foreach($_FILES['files_ready']['error'] AS $key => $archivo) {
                $file_upload = [
                    "name" => $_FILES['files_ready']['name'][$key],
                    "type" => $_FILES['files_ready']['type'][$key],
                    "tmp_name" => $_FILES['files_ready']['tmp_name'][$key],
                    "error" => $_FILES['files_ready']['error'][$key],
                    "size" => $_FILES['files_ready']['size'][$key],
                    "name_file" => ""
                ];
                $reg_archivo_valido = "/.jpg|.jpeg|.bmp|.png|.gif$/";
                $chars_replace = [" ", "Ñ", "ñ", "á", "Á", "é", "É", "í", "Í", "ó", "Ó", "ú", "Ú", "/", "?", "<", ">", "'", "`", '"'];
                $replace_chars_with= ["_", "N", "n", "a", "A", "e", "E", "i", "I", "o", "O", "u", "U", "", "", "", "", "", "", ""];
                $special_chars_replace = [" ", "-", "_", "&", "$", "#"];
                $pre_name = str_replace($chars_replace, $replace_chars_with, $file_upload['name']);
                $file_upload['name_file'] = str_replace($special_chars_replace, "", $pre_name);

                if(!preg_match($reg_archivo_valido, $file_upload['name_file'])){
                    $files_error[] = [
                        "file" => $file_upload['name'],
                        "status" => "error",
                        "msg" => "Extensión inválida"
                    ];
                    continue;
                }
                else{
                    ### chequear el tamaño aquí ###
                    if(move_uploaded_file($file_upload['tmp_name'], self::DIR_MEDIA . $file_upload['name_file'])){
                        $files_uploaded_successfully[] = [
                            "file" => $file_upload['name'],
                            "status" => "ok",
                            "msg" => "uploaded"
                        ];
                    }
                    else{
                        $files_uploaded_successfully[] = [
                            "file" => $file_upload['name'],
                            "status" => "error",
                            "msg" => "error al mover a la carpeta media"
                        ];
                    }
                }
            }

            if(count($files_error) == 0){
                redirectWitchToast("auth/productos/imagenes", [
                    "tipo" => "success",
                    "title" => "Finalizado",
                    "msg" => "Se han subido y guardado todos los archivos de forma correcta.",
                    "time" => 5000
                ]);
            }
            else if(count($files_error) > 0 && count($files_uploaded_successfully) > 0){
                $output_html = '<ul>';
                foreach ($files_error as $data) {
                    $output_html .= "<li><i class='bi bi-x-circle text-danger'></i>". $data['file'] ." (" .$data['msg']. ")</li>";
                }
                $output_html .= "</ul>";
                redirectWithNotification([
                    "icon" => "warning",
                    "title" => "Atención",
                    "html" => "<p class='text-center'>Se han subido ". count($files_uploaded_successfully) ." de forma correcta, pero hubo un problema al intentar guardar los siguientes archivos:</p>" . $output_html
                ], "auth/productos/imagenes");
            }
            else{
                redirectWitchToast("auth/productos/imagenes", [
                    "tipo" => "danger",
                    "title" => "Error",
                    "msg" => "Ha ocurrido un error al intentar subir todos los archivos. Intente nuevamente.",
                    "time" => 7000
                ]);
            }
        }

        static function borrarUnaImagen(){
            $file_name_to_delete = htmlspecialchars($_POST['name_file']);
            if(file_exists(self::DIR_MEDIA . $file_name_to_delete)){
                if(unlink(self::DIR_MEDIA . $file_name_to_delete)){
                    redirectWitchToast("auth/productos/imagenes", [
                        "tipo" => "success",
                        "title" => "Hecho",
                        "msg" => "El archivo <b>". $file_name_to_delete ."</b> fue eliminado correctamente.",
                        "time" => 5000
                    ]);
                }
                else{
                    redirectWitchToast("auth/productos/imagenes", [
                        "tipo" => "danger",
                        "title" => "Error",
                        "msg" => "Ha ocurrido un error al intentar borrar el archivo. Intente nuevamente.",
                        "time" => 7000
                    ]);
                }
            }
            else{
                redirectWitchToast("auth/productos/imagenes", [
                    "tipo" => "danger",
                    "title" => "Error",
                    "msg" => "No se ha encontrado el archivo en la carpeta de origen. Verifique el el nombre no haya sido cambiado o eliminado con anticipación.",
                    "time" => 7000
                ]);
            }
        }
    }
?>