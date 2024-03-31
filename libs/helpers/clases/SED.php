<?php
    class SED{
        public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', $_ENV['SED_SECRET_KEY']);
			$iv=substr(hash('sha256', $_ENV['SED_SECRET_IV']), 0, 16);
			$output=openssl_encrypt($string, $_ENV['SED_METHOD'], $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}
		public static function decryption($string){
			$key=hash('sha256', $_ENV['SED_SECRET_KEY']);
			$iv=substr(hash('sha256', $_ENV['SED_SECRET_IV']), 0, 16);
			$output=openssl_decrypt(base64_decode($string), $_ENV['SED_METHOD'], $key, 0, $iv);
			return $output;
		}
    }
?>

