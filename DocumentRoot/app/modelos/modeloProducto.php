<?php
    require_once('../modelos/database.php');
    class Product {
        private $pdo;
    
        public function __construct() {
            $pdo= new Database();
            $this->pdo = $pdo->connect();
        }

        public function getIdProduct(){
            try {
                $query = "SELECT idProduct FROM productVariant";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Manejar errores de conexión o consulta
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function getProducts() {
            try {
                $query = "SELECT * FROM productVariant";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                echo "Código de error: " . $e->getCode();
                echo "Detalles adicionales: " . implode(", ", $stmt->errorInfo());
                return false;
            }
        }

        public function updateProduct($idVariant){
            try {
            $query = "INSERT INTO productVariant ( marginPercentage) 
              VALUES (:idVariant, :marginPercentage)";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Manejar errores de conexión o consulta
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function updateAction($idVariant,$showProduct){
            try {
                $query2 = "SELECT * FROM productVariant";
                $stmt = $this->pdo->prepare($query2);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

                $query = "UPDATE productVariant SET showProduct = :action WHERE idVariant = :idVariant"; 
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(':showProduct', $showProduct, PDO::PARAM_INT);
                $stmt->bindParam(':idVariant', $idVariant, PDO::PARAM_INT);

                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                // Manejar errores de conexión o consulta
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
?>