<?php
    class EditorProductoModel extends ModelTools{
        private $db;
        private $id_producto;
        private $nro_art;
        private $nombre;
        private $precio;
        private $procio_unitario;
        private $stock;
        private $descri_c;
        private $descri_l;
        private $orden;
        private $tags;
        private $talles;
        private $visible;

        public function __construct(){
            $this->db = self::conectar();
        }

        public function getAllCategoriasSelector(){
            try{
                $sql = "SELECT * FROM categorias ORDER BY nombrecat ASC";
                $stmt = $this->db->query($sql);
                if(!$stmt){
                    return false;
                }
                else{
                    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $registros;
                }
            }
            catch(PDOException $e){
                Logger::error("EditorProductoModel - getAllCategoriasSelector - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        /**
         * Get the value of id_producto
         */ 
        public function getId_producto(){
            return $this->id_producto;
        }

        /**
         * Set the value of id_producto
         *
         * @return  self
         */ 
        public function setId_producto($id_producto){
            $this->id_producto = $id_producto;
            return $this;
        }

        /**
         * Get the value of nro_art
         */ 
        public function getNro_art(){
            return $this->nro_art;
        }

        /**
         * Set the value of nro_art
         *
         * @return  self
         */ 
        public function setNro_art($nro_art){
            $this->nro_art = $nro_art;
            return $this;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre(){
            return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre){
            $this->nombre = $nombre;
            return $this;
        }

        /**
         * Get the value of precio
         */ 
        public function getPrecio(){
            return $this->precio;
        }

        /**
         * Set the value of precio
         *
         * @return  self
         */ 
        public function setPrecio($precio){
            $this->precio = $precio;
            return $this;
        }

        /**
         * Get the value of procio_unitario
         */ 
        public function getProcio_unitario(){
            return $this->procio_unitario;
        }

        /**
         * Set the value of procio_unitario
         *
         * @return  self
         */ 
        public function setProcio_unitario($procio_unitario){
            $this->procio_unitario = $procio_unitario;
            return $this;
        }

        /**
         * Get the value of stock
         */ 
        public function getStock(){
            return $this->stock;
        }

        /**
         * Set the value of stock
         *
         * @return  self
         */ 
        public function setStock($stock){
            $this->stock = $stock;
            return $this;
        }

        /**
         * Get the value of descri_c
         */ 
        public function getDescri_c(){
            return $this->descri_c;
        }

        /**
         * Set the value of descri_c
         *
         * @return  self
         */ 
        public function setDescri_c($descri_c){
            $this->descri_c = $descri_c;
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
         * Get the value of tags
         */ 
        public function getTags(){
            return $this->tags;
        }

        /**
         * Set the value of tags
         *
         * @return  self
         */ 
        public function setTags($tags){
            $this->tags = $tags;
            return $this;
        }

        /**
         * Get the value of talles
         */ 
        public function getTalles(){
            return $this->talles;
        }

        /**
         * Set the value of talles
         *
         * @return  self
         */ 
        public function setTalles($talles){
            $this->talles = $talles;
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
    }
?>