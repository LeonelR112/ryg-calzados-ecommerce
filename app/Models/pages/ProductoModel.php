<?php
    class ProductoModel extends ModelTools{
        private $db;

        public function __construct(){
            $this->db = self::conectar();
        }

        public function getAllProductos(){
            try{
                $sql = "SELECT * FROM tmp_productos ORDER BY orden ASC";
                $stmt = $this->db->query($sql);
                if(!$stmt->execute()){
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
    }
?>