<?php
    use eftec\bladeone\BladeOne;

    //atajo a carpetas
    function resources(string $ruta){
        return MAIN_URL . "resources/" . $ruta;
    } 

    function assets(string $ruta){
        return MAIN_URL . "resources/assets/" . $ruta;
    } 

    function css(string $ruta){
        return MAIN_URL . "resources/css/" . $ruta;
    } 

    function js(string $ruta){
        return MAIN_URL . "resources/js/" . $ruta;
    }
    // fin atajos a carpetas

    //obtener un archivo del resource
    function cssFile(string $dirname, bool $cache = true){
        echo '<link rel="stylesheet" href="'. MAIN_URL .'resources/css/'. $dirname .'.css'. ($cache ? "" : "?v" . md5(time())) .'">';
    }

    function jsFile(string $dirname, bool $cache = true){
        echo '<script src="'. MAIN_URL .'resources/js/'. $dirname .'.js'. ($cache ? "" : "?v" . md5(time())) .'"></script>';
    }
    //fin obtener un archivo del resource

    //API archivos
    function responseAPI($respuesta, int $status_code){
        $response = json_encode($respuesta);
        http_response_code($status_code);
        print $response;
    }

    //mensajes de alerta
    function printMensajeAlertaCritica(string $mensaje){
        echo "
            <div style='padding: 1.2em;margin:15px;border: 1px solid red;color: rgb(153, 8, 8);background-color: rgb(255, 182, 182);'>
                <h3>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-exclamation-octagon-fill' viewBox='0 0 16 16'>
                        <path d='M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
                    </svg> 
                    Error crítico!
                </h3>
                <p>
                    ". $mensaje ."
                </p>
            </div>
        ";
    }

    function route(string $url, array $post_params = [], array $get_params = []){
        $url = htmlspecialchars(addslashes($url));
        $url_destiny = MAIN_URL;
        $url_destiny .= $url;
        if($url == ""){
            return $url_destiny;
        }
        else{
            if(substr($url, -1) != "/"){ 
                //la url pasada no tiene en el final un slash, se le adiciona directamente en la funión del route
                $url_destiny .= "/";
            }

            if(count($post_params) > 0){
                foreach ($post_params AS $key => $valor) {
                    $url_destiny .= $key . "/" . $valor . "/";
                }
            }

            if(count($get_params) > 0){
                $url_destiny .= "?";
                $total_parametros = count($get_params);
                $agregados = 0;
                foreach ($get_params as $key => $valor) {
                    $valor = preg_replace("/\s/", "%20", $valor);
                    $url_destiny .= $key . "=" . $valor;
                    $agregados ++;
                    if($agregados < $total_parametros){
                        $url_destiny .= "&";
                    }
                }
            }

            return $url_destiny;
        }
    }

    function redirectTo(string $url){
        try{
            //si la url = "", se redirecciona a la homepage
            header("location: " . MAIN_URL . $url);
            exit;
        }
        catch(Exception $e){
            Logger::error("Helpers > redirecTo - " . $e->getMessage());
            return false;
        }
    }
    
    function current_date(){
        $DateTimeNow = new DateTime('now');
        return $DateTimeNow;
    }

    // Strings
    function truncateString($string, $length, $dots = "...") {
        return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
    }

    function capitalizeStrings($valor){
        return ucwords($valor);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    // Fin strings

    function isSpam(string $text){
        $regLinks = "/((http|https|www)[^\s]+)|(@[^\s]+)|(#[^\s]+)/";
        if(preg_match($regLinks, $text)){
            return true;
        }
        else{
            return false;
        }
    }

    function view(string $template, array $params = []){
        $blade = new BladeOne(VIEWS, CACHE_BLADE, BladeOne::MODE_DEBUG);
        echo $blade->run($template, $params);
    }

    function paginationCSS(){
        echo "<link rel='stylesheet' href='" . MAIN_URL ."resources/css/pagination.css'>";
    }

    function paginationJS(){
        echo '<script src="'. MAIN_URL .'resources/js/pagination.js"></script>';
    }

    function lightboxCSS(){
        echo '<link rel="stylesheet" href="'.MAIN_URL.'resources/css/lightbox.css">';
    }

    function lightboxJS(){
        echo '<script src="'. MAIN_URL. 'resources/js/lightbox.js"></script>';
    }

    function getFilesOnlyImgsFromMediaFolder(){
        $list_files_folder = scandir(__DIR__ . "/../../media");
        $preg_imgs = "/(.gif|.png|.jpg|.jpeg|.gif)$/";
        $final_list = [];
        foreach ($list_files_folder as $file) {
            if($file == "." || $file == ".." || $file == 'mini'){
                continue;
            }
            else if(preg_match($preg_imgs, $file)){
                array_push($final_list, $file);
            }
        }
        return $final_list;
    }

    /* Obtener nombre de una url de un archivo */
    function getNombreFileDeUrl($url){
        $ArrayInfo = pathinfo($url);
        $nombreArchivo = $ArrayInfo['filename'];
        return $nombreArchivo;
    }

    function redirectWitchToast(string $ruta, array $datos_notificacion){
        $class = "";
        $icon = '';
        if(isset($datos_notificacion['tipo'])){
            $tipo = $datos_notificacion['tipo'];
            if($tipo == 'primary'){
                $class = 'text-dark bg-primary';
            }
            if($tipo == 'secondary'){
                $class = 'text-light bg-secondary';
            }
            if($tipo == 'warning'){
                $icon = '<i class="bi bi-exclamation-triangle"></i>';
                $class = 'text-dark bg-warning';
            }
            if($tipo == 'success'){
                $icon = '<i class="bi bi-check2-circle"></i>';
                $class = 'text-light bg-success';
            }
            if($tipo == 'danger'){
                $icon = '<i class="bi bi-x-circle"></i>';
                $class = 'text-light bg-danger';
            }
            if($tipo == 'info'){
                $icon = '<i class="bi bi-info-circle"></i>';
                $class = 'text-light bg-info';
            }
        }
        
        $_SESSION['notificacion_toast'] = [
            "classes" => $class, // clase a mostrar según el tipo especificado
            "title" => $icon . " " . $datos_notificacion['title'],
            "msg" => $datos_notificacion['msg'],
            "time" => isset($datos_notificacion['time']) ? $datos_notificacion['time'] : 3000 // Tiempo que se mostrará el toast en milisegundos (ms), default 3000ms = 3 segundos
        ];
        header("location: " . MAIN_URL . $ruta);
        exit;
    }

    function redirectWithNotification(array $datosNoti, string $url){
        try{
            $_SESSION['notification'] = [
                "icon" => $datosNoti['icon'],
                "title" => $datosNoti['title'],
                "html" => $datosNoti['html']
            ];
            
            header("location: " . MAIN_URL . $url);
            exit;
        }
        catch(Exception $e){
            Logger::error("Helpers > redirectWithNotification - " . $e->getMessage());
            return false;
        }
    }

    function obtenerTipoDeCondicion(int $param, string $valor){
        if($param == 1){
            return " = '" . $valor . "'";
        }
        else if($param == 2){
            return " LIKE '%" . $valor . "%'";
        }
        else if($param == 3){
            return " NOT LIKE '%" . $valor . "%'";
        }
        else if($param == 4){
            return " >= '" . $valor . "'";
        }
        else if($param == 5){
            return " <= '" . $valor . "'";
        }
        else{
            return false;
        }
    }

    /**
     *  Identifica la uri que ingresa y devuelve true si coincide con la url actual
     */ 
    function isActive(string $section_page) {
        $url_actual = $_SERVER['REQUEST_URI'];
        $patron = "/" . preg_quote($section_page, "/") . "/";
        return preg_match($patron, $url_actual) == 1;
    }
?>