<?php
    class CategoriaModel{
        private $db;
        private $id_categ;
        private $nombrecat;
        private $orden;
        private $desci_c;
        private $descri_l;
        private $imagen;
        private $visible;
        private $color;

        

        /**
         * Get the value of id_categ
         */ 
        public function getId_categ(){
            return $this->id_categ;
        }

        /**
         * Set the value of id_categ
         *
         * @return  self
         */ 
        public function setId_categ($id_categ){
            $this->id_categ = $id_categ;
            return $this;
        }

        /**
         * Get the value of nombrecat
         */ 
        public function getNombrecat(){
            return $this->nombrecat;
        }

        /**
         * Set the value of nombrecat
         *
         * @return  self
         */ 
        public function setNombrecat($nombrecat){
            $this->nombrecat = $nombrecat;
            return $this;
        }

        /**
         * Get the value of orden
         */ 
        public function getOrden(){
            return $this->orden;
        }

        /**
         * Set the value of orden
         *
         * @return  self
         */ 
        public function setOrden($orden){
            $this->orden = $orden;
            return $this;
        }

        /**
         * Get the value of desci_c
         */ 
        public function getDesci_c(){
            return $this->desci_c;
        }

        /**
         * Set the value of desci_c
         *
         * @return  self
         */ 
        public function setDesci_c($desci_c){
            $this->desci_c = $desci_c;
            return $this;
        }

        /**
         * Get the value of descri_l
         */ 
        public function getDescri_l(){
            return $this->descri_l;
        }

        /**
         * Set the value of descri_l
         *
         * @return  self
         */ 
        public function setDescri_l($descri_l){
            $this->descri_l = $descri_l;
            return $this;
        }

        /**
         * Get the value of imagen
         */ 
        public function getImagen(){
            return $this->imagen;
        }

        /**
         * Set the value of imagen
         *
         * @return  self
         */ 
        public function setImagen($imagen){
            $this->imagen = $imagen;
            return $this;
        }

        /**
         * Get the value of visible
         */ 
        public function getVisible(){
            return $this->visible;
        }

        /**
         * Set the value of visible
         *
         * @return  self
         */ 
        public function setVisible($visible){
            $this->visible = $visible;
            return $this;
        }

        /**
         * Get the value of color
         */ 
        public function getColor(){
            return $this->color;
        }

        /**
         * Set the value of color
         *
         * @return  self
         */ 
        public function setColor($color){
            $this->color = $color;
            return $this;
        }
    }
?>