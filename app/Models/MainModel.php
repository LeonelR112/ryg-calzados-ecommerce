<?php
    class MainModel extends ModelTools{
        private $db;

        public function __construct(){
            $this->db = self::conectar();
        }

        public function testingModel(){
            echo "Model cargado";
        }
    }
?>