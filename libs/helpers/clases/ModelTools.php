<?php
    abstract class ModelTools extends Conexion{
        static function setErrorLog(string $error_status, string $message){
            Logger::$error_status($message);
        }

        /**
         *  1 = Critical (die) | 2 = Error fatal (die) | 3 = warning | 4 = notice | 5 = info
        */
        static function showErrorMessage(int $error_level, string $message){
            $output_html = '';
            if($error_level == 1){
                // Crítico
                $output_html = '<div style="margin:15px;width:90%;border:1px solid #ff875b;background-color:#fceaea;padding:7px;color:red;">'. $message .'</div>';
                echo $output_html;
                die;
            }
            else if($error_level == 2){
                // Error fatal
                $output_html = '<div style="margin:15px;width:90%;border:1px solid #ff875b;background-color:#fceaea;padding:7px;color:black;">'. $message .'</div>';
                echo $output_html;
                die;
            }
            else if($error_level == 3){
                // Warning
                $output_html = '<div style="margin:15px;width:90%;border:1px solid #000;background-color:#FFC107;padding:7px;color:black;">'. $message .'</div>';
            }
            else if($error_level == 4){
                // Notice
                $output_html = '<div style="margin:15px;width:90%;border:1px solid #000;background-color:#0DCAF0;padding:7px;color:black;">'. $message .'</div>';
            }
            else if($error_level == 5){
                // Info
                $output_html = '<div style="margin:15px;width:90%;border:1px solid #000;background-color:#343A40;padding:7px;color:white;">'. $message .'</div>';
            }
            else{
                $output_html = $message;
            }
            echo $output_html;
        }
    }
?>