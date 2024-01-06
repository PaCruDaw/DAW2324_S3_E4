<?php
    include('../modelos/database.php');
    class Product {
        private $pdo;
        private $idVariant;
        private $idProduct;
        private $size;
        private $variantName;
        private $format_width;
        private $format_height;
        private $marginPercentage;
        private $showProduct;
    
        public function __construct() {
            $pdo= new Database();
            $this->pdo = $pdo->connect();
        }
        
        //getters
        public function getIdVariant() {
            return $this->idVariant;
        }

        public function getIdProduct() {
            return $this->idProduct;
        }
    
        public function getVariantName() {
            return $this->variantName;
        }

        public function getSize() {
            return $this->size;
        }
    
        public function getFormatWidth() {
            return $this->format_width;
        }
        
        public function getFormatHeight() {
            return $this->format_height;
        }
    
        public function getMarginPercentage() {
            return $this->marginPercentage;
        }

        public function getShowProduct() {
            return $this->showProduct;
        }


        public function getProducts() {
            try {
                $query = "SELECT * FROM productVariant";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Manejar errores de conexión o consulta
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function updateProduct($idProduct){
            try {
            $query = "INSERT INTO productVariant ( marginPercentage, showProduct) 
              VALUES (:idVariant, :marginPercentage, :showProduct)";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Manejar errores de conexión o consulta
                echo "Error: " . $e->getMessage();
                return false;
            }

        }
    }
    
?>