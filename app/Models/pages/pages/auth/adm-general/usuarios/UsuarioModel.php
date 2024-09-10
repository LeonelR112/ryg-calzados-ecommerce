<?php
    class UsuarioModel extends ModelTools{
        private $db;
        private $id_usuario;
        private $nombre;
        private $email;
        private $telefono;
        private $password;
        private $categoria;
        private $creado_en;
        private $actualizado_en;
        private $token_recovery;
        private $estado;
        private $verificado;
        private $mensaje_solicitud;

        public function __construct(){
            $this->db = self::conectar();
        }

        public function getAllUsuarios(){
            try{
                $sql = "SELECT * FROM usuarios ORDER BY creado_en DESC";
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
                Logger::error("ProductoModel - getAllProductos - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function getUsuario(int $id_usuario){
            try{
                $sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    $registro = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $registro;
                }
            }
            catch(PDOException $e){
                Logger::error("ProductoModel - getUsuario - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function addUsuario(array $datos){
            try{
                $sql = "INSERT INTO usuarios (nombre, email, telefono, password, categoria, creado_en, actualizado_en, estado, verificado, mensaje_solicitud) VALUES 
                (:nombre, :email, :telefono, :password, :categoria, :creado_en, :actualizado_en, :estado, :verificado, :mensaje_solicitud)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
                $stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_INT);
                $stmt->bindParam(":password", $datos['contrasena'], PDO::PARAM_STR);
                $stmt->bindParam(":categoria", $datos['categoria'], PDO::PARAM_INT);
                $stmt->bindParam(":creado_en", $datos['creado_en'], PDO::PARAM_STR);
                $stmt->bindParam(":actualizado_en", $datos['actualizado_en'], PDO::PARAM_STR);
                $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);
                $stmt->bindParam(":verificado", $datos['verificado'], PDO::PARAM_STR);
                $stmt->bindParam(":mensaje_solicitud", $datos['mensaje_solicitud'], PDO::PARAM_STR);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    $this->setId_usuario($this->db->lastInsertId());
                    $this->setNombre($datos['nombre']);
                    $this->setEmail($datos['email']);
                    $this->setTelefono($datos['telefono']);
                    $this->setPassword($datos['contrasena']);
                    $this->setCategoria($datos['categoria']);
                    $this->setCreado_en($datos['creado_en']);
                    $this->setActualizado_en($datos['actualizado_en']);
                    $this->setEstado($datos['estado']);
                    $this->setVerificado($datos['verificado']);
                    $this->setMensaje_solicitud($datos['mensaje_solicitud']);
                    return $this;
                }
            }
            catch(PDOException $e){
                Logger::error("ProductoModel - addUsuario - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function updateUsuario(array $datos){
            try{
                $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, telefono = :telefono, password = :password, categoria = :categoria, actualizado_en = :actualizado_en, estado = :estado, verificado = :verificado WHERE id_usuario = :id_usuario";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
                $stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_INT);
                $stmt->bindParam(":password", $datos['contrasena'], PDO::PARAM_STR);
                $stmt->bindParam(":categoria", $datos['categoria'], PDO::PARAM_INT);
                $stmt->bindParam(":actualizado_en", $datos['actualizado_en'], PDO::PARAM_STR);
                $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);
                $stmt->bindParam(":verificado", $datos['verificado'], PDO::PARAM_STR);
                $stmt->bindParam("id_usuario", $datos['id_usuario'], PDO::PARAM_INT);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    $this->setId_usuario($datos['id_usuario']);
                    $this->setNombre($datos['nombre']);
                    $this->setEmail($datos['email']);
                    $this->setTelefono($datos['telefono']);
                    $this->setPassword($datos['contrasena']);
                    $this->setCategoria($datos['categoria']);
                    $this->setActualizado_en($datos['actualizado_en']);
                    $this->setEstado($datos['estado']);
                    $this->setVerificado($datos['verificado']);
                    return $this;
                }
            }
            catch(PDOException $e){
                Logger::error("ProductoModel - updateUsuario - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function deleteUsuario(int $id_usuario){
            try{
                $sql = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
                if(!$stmt->execute()){
                    return false;
                }
                else{
                    return true;
                }
            }
            catch(PDOException $e){
                Logger::error("ProductoModel - addUsuario - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        /**
         * Get the value of id_usuario
         */ 
        public function getId_usuario(){
            return $this->id_usuario;
        }

        /**
         * Set the value of id_usuario
         *
         * @return  self
         */ 
        public function setId_usuario($id_usuario){
            $this->id_usuario = $id_usuario;
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
         * Get the value of email
         */ 
        public function getEmail(){
            return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email){
            $this->email = $email;
            return $this;
        }

        /**
         * Get the value of telefono
         */ 
        public function getTelefono(){
            return $this->telefono;
        }

        /**
         * Set the value of telefono
         *
         * @return  self
         */ 
        public function setTelefono($telefono){
            $this->telefono = $telefono;
            return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword(){
            return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password){
            $this->password = $password;
            return $this;
        }

        /**
         * Get the value of categoria
         */ 
        public function getCategoria(){
            return $this->categoria;
        }

        /**
         * Set the value of categoria
         *
         * @return  self
         */ 
        public function setCategoria($categoria){
            $this->categoria = $categoria;
            return $this;
        }

        /**
         * Get the value of creado_en
         */ 
        public function getCreado_en(){
            return $this->creado_en;
        }

        /**
         * Set the value of creado_en
         *
         * @return  self
         */ 
        public function setCreado_en($creado_en){
            $this->creado_en = $creado_en;
            return $this;
        }

        /**
         * Get the value of actualizado_en
         */ 
        public function getActualizado_en(){
            return $this->actualizado_en;
        }

        /**
         * Set the value of actualizado_en
         *
         * @return  self
         */ 
        public function setActualizado_en($actualizado_en){
            $this->actualizado_en = $actualizado_en;
            return $this;
        }

        /**
         * Get the value of token_recovery
         */ 
        public function getToken_recovery(){
            return $this->token_recovery;
        }

        /**
         * Set the value of token_recovery
         *
         * @return  self
         */ 
        public function setToken_recovery($token_recovery){
            $this->token_recovery = $token_recovery;
            return $this;
        }

        /**
         * Get the value of estado
         */ 
        public function getEstado(){
            return $this->estado;
        }

        /**
         * Set the value of estado
         *
         * @return  self
         */ 
        public function setEstado($estado){
            $this->estado = $estado;
            return $this;
        }

        /**
         * Get the value of verificado
         */ 
        public function getVerificado(){
            return $this->verificado;
        }

        /**
         * Set the value of verificado
         *
         * @return  self
         */ 
        public function setVerificado($verificado){
            $this->verificado = $verificado;
            return $this;
        }

        /**
         * Get the value of mensaje_solicitud
         */ 
        public function getMensaje_solicitud(){
            return $this->mensaje_solicitud;
        }

        /**
         * Set the value of mensaje_solicitud
         *
         * @return  self
         */ 
        public function setMensaje_solicitud($mensaje_solicitud){
            $this->mensaje_solicitud = $mensaje_solicitud;
            return $this;
        }
    }
?>