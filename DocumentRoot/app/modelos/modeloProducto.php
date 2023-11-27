<?php
    include('../modelos/database.php');
    class Product {
        private $pdo;
        private $id;
        private $nombre_producto;
        private $descripcion_producto;
        private $precio;
        private $margen_porcentaje;
        private $table_name="producto";
    
        public function __construct() {
            $pdo= new Database();
            $this->pdo = $pdo->connect();
            
        }
        
        //getters
        public function getId() {
            return $this->id;
        }
    
        public function getNombreProducto() {
            return $this->nombre_producto;
        }
    
        public function getDescripcionProducto() {
            return $this->descripcion_producto;
        }
    
        public function getPrecio() {
            return $this->precio;
        }
    
        public function getMargenPorcentaje() {
            return $this->margen_porcentaje;
        }


        public function getProducts() {
            try {
                $query = "SELECT * FROM producto";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Manejar errores de conexión o consulta
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function updateProduct($productoID){
            try {
            $query = "INSERT INTO producto ( nombre_producto, decripcion_producto, precio, margen_porcentaje) 
              VALUES (:id, :nombre_producto, :decripcion_producto, :precio, :margen_porcentaje)";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Manejar errores de conexión o consulta
                echo "Error: " . $e->getMessage();
                return false;
            }

        }

        // Método para eliminar un producto por su ID
        public function deleteProduct($productoID) {
            try {
                $query = "DELETE FROM producto WHERE id = :productoID";
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(':productoID', $productoID, PDO::PARAM_INT);
                $stmt->execute();
                return true; // Éxito al eliminar
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false; // Error al eliminar
            }
        }

        public function insertProduct($nombre_producto, $descripcion_producto, $precio, $margen_porcentaje) {
            try {
                // Preparar la consulta SQL
                $query = "INSERT INTO producto (nombre_producto, descripcion_producto, precio, margen_porcentaje) VALUES (:nombre, :descripcion, :precio, :margen)";
    
                // Preparar la sentencia
                $stmt = $this->pdo->prepare($query);
    
                // Asignar valores a los parámetros
                $stmt->bindParam(':nombre', $nombre_producto);
                $stmt->bindParam(':decripcion_producto', $descripcion_producto);
                $stmt->bindParam(':precio', $precio);
                $stmt->bindParam(':margen_porcentaje', $margen_porcentaje);
    
                // Ejecutar la sentencia
                $stmt->execute();
    
                // Devolver true si la inserción fue exitosa
                return true;
            } catch (PDOException $e) {
                // Manejar errores de la base de datos
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
    
?>