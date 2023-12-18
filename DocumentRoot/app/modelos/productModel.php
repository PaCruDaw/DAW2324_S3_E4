<?php
    include('../modelos/database.php');
    class Product {
        private $pdo;
        private $id;
        private $margen_porcentaje;
    
        public function __construct() {
            $pdo= new Database();
            $this->pdo = $pdo->connect();
        }

        public function getProducts() {
            try {
                $query = "SELECT P.idProduct, P.productName, PV.idVariant, PV.size, PV.variantName, PV.marginPercentage, PV.showProduct FROM products AS P, productVariant AS PV WHERE P.idProduct = PV.idProduct";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Manejar errores de conexión o consulta
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function updateProduct($id, $margen_porcentaje){
            try {
            $query = "UPDATE productVariant SET `marginPercentage` = :margen_porcentaje WHERE idVariant = :id";
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                $stmt->bindParam(':margen_porcentaje', $margen_porcentaje, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $e) {
                // Manejar errores de conexión o consulta
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
    $product = new Product();
?>