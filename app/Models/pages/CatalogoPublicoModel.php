<?php
    class CatalogoPublicoModel extends ModelTools{
        private $db;
        
        public function __construct(){
            $this->db = self::conectar();
        }

        public function getAllCategoriasVisibles(){
            try{
                $sql = "SELECT * FROM categorias WHERE visible = 'S' ORDER BY orden ASC";
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
                Logger::error("CatalogoPublicoModel - getAllCategoriasVisibles - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }

        public function getAllProductosVisibles(){
            try{
                $sql = "SELECT pro.id_producto, pro.nro_art, pro.nombreprod, pro.precio, pro.precio_unitario, pro.stock, pro.descri_c, pro.descri_l, pro.orden, pro.tags, pro.talles, pro.visible, COALESCE(img_s.url_img, img_n.url_img) AS imagen FROM productos AS pro LEFT OUTER JOIN (SELECT id_producto, url_img FROM pro_img WHERE principal = 'S') AS img_s ON pro.id_producto = img_s.id_producto LEFT OUTER JOIN (SELECT id_producto, url_img FROM pro_img WHERE principal = 'N') AS img_n ON pro.id_producto = img_n.id_producto WHERE pro.visible = 'S' GROUP BY pro.id_producto ORDER BY pro.id_producto DESC";
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
                Logger::error("CatalogoPublicoModel - getAllProductosVisibles - " . $e->getMessage(), "Posible desconexión");
                ModelTools::showErrorMessage(1, "No se pudo obtener los datos solicitados, el programa no puede continuar. Mas info en logs");
            }
        }
    }
?>