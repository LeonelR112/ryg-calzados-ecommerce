<?php
    class CategoriaModel extends ModelTools{
        private $db;
        private $id_categ;
        private $nombrecat;
        private $orden;
        private $desci_c;
        private $descri_l;
        private $imagen;
        private $visible;
        private $color;

        function __construct(){
            $this->db = self::conectar();
        }        

        public function getAllCategorias(){
            try{
                $sql = "SELECT * FROM categorias ORDER BY orden ASC";
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
                Logger::error("CategoriaModel - getAllCategorias - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function getCategoria(int $id_categ){
            try{
                $sql = "SELECT * FROM categorias WHERE id_categ = :id_categ";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id_categ", $id_categ, PDO::PARAM_INT);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    $registro = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $registro;
                }
            }
            catch(PDOException $e){
                Logger::error("CategoriaModel - getCategoria - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function addCategoria(array $datos){
            try{
                $sql = "INSERT INTO categorias (nombrecat, orden, descri_c, descri_l, imagen, visible, color) VALUES (:nombrecat, :orden, :descri_c, :descri_l, :imagen, :visible, :color)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":nombrecat", $datos['nombrecat'], PDO::PARAM_STR);
                $stmt->bindParam(":orden", $datos['orden'], PDO::PARAM_STR);
                $stmt->bindParam(":descri_c", $datos['descri_c'], PDO::PARAM_STR);
                $stmt->bindParam(":descri_l", $datos['descri_l'], PDO::PARAM_STR);
                $stmt->bindParam(":imagen", $datos['imagen'], PDO::PARAM_STR);
                $stmt->bindParam(":visible", $datos['visible'], PDO::PARAM_STR);
                $stmt->bindParam(":color", $datos['color'], PDO::PARAM_STR);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    $this->setId_categ($this->db->lastInsertId());
                    $this->setNombrecat($datos['nombrecat']);
                    $this->setOrden($datos['orden']);
                    $this->setDesci_c($datos['descri_c']);
                    $this->setDescri_l($datos['descri_l']);
                    $this->setImagen($datos['imagen']);
                    $this->setVisible($datos['visible']);
                    $this->setColor($datos['color']);
                    return $this;
                }
            }
            catch(PDOException $e){
                Logger::error("CategoriaModel - addCategoria - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function updateCategoria(array $datos){
            try{
                $sql = "UPDATE categorias SET nombrecat = :nombrecat, orden = :orden, descri_c = :descri_c, descri_l = :descri_c, imagen = :imagen, visible = :visible, color = :color WHERE id_categ = :id_categ";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":nombrecat", $datos['nombrecat'], PDO::PARAM_STR);
                $stmt->bindParam(":orden", $datos['orden'], PDO::PARAM_STR);
                $stmt->bindParam(":descri_c", $datos['descri_c'], PDO::PARAM_STR);
                $stmt->bindParam(":descri_l", $datos['descri_l'], PDO::PARAM_STR);
                $stmt->bindParam(":imagen", $datos['imagen'], PDO::PARAM_STR);
                $stmt->bindParam(":visible", $datos['visible'], PDO::PARAM_STR);
                $stmt->bindParam(":color", $datos['color'], PDO::PARAM_STR);
                $stmt->bindParam(":id_categ", $datos['id_categ'], PDO::PARAM_INT);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    $this->setId_categ($datos['id_categ']);
                    $this->setNombrecat($datos['nombrecat']);
                    $this->setOrden($datos['orden']);
                    $this->setDesci_c($datos['descri_c']);
                    $this->setDescri_l($datos['descri_l']);
                    $this->setImagen($datos['imagen']);
                    $this->setVisible($datos['visible']);
                    $this->setColor($datos['color']);
                    return $this;
                }
            }
            catch(PDOException $e){
                Logger::error("CategoriaModel - updateCategoria - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function deleteCategoria(int $id_categ){
            try{
                $sql = "DELETE FROM categorias WHERE id_categ = :id_categ";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("id_categ", $id_categ, PDO::PARAM_INT);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    return true;
                }
            }
            catch(PDOException $e){
                Logger::error("CategoriaModel - deleteCategoria - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

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