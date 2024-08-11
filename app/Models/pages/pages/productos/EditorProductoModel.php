<?php
    class EditorProductoModel extends ModelTools{
        private $db;
        private $id_producto;
        private $nro_art;
        private $nombreprod;
        private $precio;
        private $precio_unitario;
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

        public function getAllProductos(){
            try{
                $sql = "SELECT pro.id_producto, pro.nro_art, pro.nombreprod, pro.precio, pro.precio_unitario, pro.stock, pro.descri_c, pro.descri_l, pro.orden, pro.tags, pro.talles, pro.visible, COALESCE(img_s.url_img, img_n.url_img) AS imagen FROM productos AS pro LEFT OUTER JOIN (SELECT id_producto, url_img FROM pro_img WHERE principal = 'S') AS img_s ON pro.id_producto = img_s.id_producto LEFT OUTER JOIN (SELECT id_producto, url_img FROM pro_img WHERE principal = 'N') AS img_n ON pro.id_producto = img_n.id_producto ORDER BY pro.id_producto DESC";
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
                Logger::error("EditorProductoModel - getAllProductos - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function addProducto(array $datos){
            try{
                $sql = "INSERT INTO productos (nro_art, nombreprod, precio, precio_unitario, stock, descri_c, descri_l, orden, tags, talles, visible) VALUES (:nro_art, :nombreprod, :precio, :precio_unitario, :stock, :descri_c, :descri_l, :orden, :tags, :talles, :visible)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":nro_art", $datos['nro_art'], PDO::PARAM_INT);
                $stmt->bindParam(":nombreprod", $datos['nombreprod'], PDO::PARAM_STR);
                $stmt->bindParam(":precio", $datos['precio'], PDO::PARAM_STR);
                $stmt->bindParam(":precio_unitario", $datos['precio_unitario'], PDO::PARAM_STR);
                $stmt->bindParam(":stock", $datos['stock'], PDO::PARAM_STR);
                $stmt->bindParam(":descri_c", $datos['descri_c'], PDO::PARAM_STR);
                $stmt->bindParam(":descri_l", $datos['descri_l']);
                $stmt->bindParam(":orden", $datos['orden'], PDO::PARAM_STR);
                $stmt->bindParam(":tags", $datos['tags'], PDO::PARAM_STR);
                $stmt->bindParam(":talles", $datos['talles'], PDO::PARAM_STR);
                $stmt->bindParam(":visible", $datos['visible'], PDO::PARAM_STR);
                if(!$stmt->execute()){
                    $errorInfo = $stmt->errorInfo();
                    Logger::error("Error en la ejecución de la consulta en EditorProductoModel: " . implode(", ", $errorInfo), "Error en PDO");
                    return false;
                }
                else{
                    $this->setId_producto((int)$this->db->lastInsertId());
                    $this->setNro_art($datos['nro_art']);
                    $this->setNombreprod($datos['nombreprod']);
                    $this->setPrecio($datos['precio']);
                    $this->setPrecio_unitario($datos['precio_unitario']);
                    $this->setStock($datos['stock']);
                    $this->setDescri_c($datos['descri_c']);
                    $this->setDescri_l($datos['descri_l']);
                    $this->setOrden($datos['orden']);
                    $this->setTags($datos['tags']);
                    $this->setTalles($datos['talles']);
                    $this->setVisible($datos);
                    return $this;
                }
            }
            catch(PDOException $e){
                Logger::error("EditorProductoModel - addProducto - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function guardarImagenesDeUnProducto(int $id_producto, array $datos_imagenes){
            try{
                $total_imagenes = count($datos_imagenes);
                $procesados = 0;
                $sql = "INSERT INTO pro_img (id_producto, url_img, principal) VALUES ";
                foreach ($datos_imagenes as $key => $img_props) {
                    $sql .= "(:id_producto". $key .", :url_img". $key .", :principal". $key .")";
                    $procesados ++;
                    if($procesados < $total_imagenes) $sql .= ", "; 
                }
                $stmt = $this->db->prepare($sql);
                foreach ($datos_imagenes as $key => $img_props) {
                    $stmt->bindParam(":id_producto" . $key, $id_producto, PDO::PARAM_INT);
                    $stmt->bindParam(":url_img" . $key, $img_props['url_image'], PDO::PARAM_STR);
                    $stmt->bindParam(":principal" . $key, $img_props['principal'], PDO::PARAM_STR);
                }
                if(!$stmt->execute()){
                    $errorInfo = $stmt->errorInfo();
                    Logger::error("Error en la ejecución de la consulta en EditorProductoModel: " . implode(", ", $errorInfo), "Error en PDO");
                    return false;
                }
                else{
                    return true;
                }
            }
            catch(PDOException $e){
                Logger::error("EditorProductoModel - guardarImagenesDeUnProducto - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function deleteProducto(int $id_producto){
            try{
                $sql = "DELETE FROM productos WHERE id_producto = :id_producto";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
                if(!$stmt->execute()){
                    $errorInfo = $stmt->errorInfo();
                    Logger::error("Error en la ejecución de la consulta en EditorProductoModel: " . implode(", ", $errorInfo), "Error en PDO");
                    return false;
                }
                else{
                    return true;
                }
            }
            catch(PDOException $e){
                Logger::error("EditorProductoModel - deleteProducto - " . $e->getMessage(), "Posible desconexión");
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

        /**
         * Get the value of nombreprod
         */ 
        public function getNombreprod(){
            return $this->nombreprod;
        }

        /**
         * Set the value of nombreprod
         *
         * @return  self
         */ 
        public function setNombreprod($nombreprod){
            $this->nombreprod = $nombreprod;
            return $this;
        }

        /**
         * Get the value of precio_unitario
         */ 
        public function getPrecio_unitario(){
            return $this->precio_unitario;
        }

        /**
         * Set the value of precio_unitario
         *
         * @return  self
         */ 
        public function setPrecio_unitario($precio_unitario){
            $this->precio_unitario = $precio_unitario;
            return $this;
        }
    }
?>