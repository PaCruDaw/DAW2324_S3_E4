<?php
require_once "../modelos/database.php";

class Cms {
    private $pdo;
 
    public function __construct()
    {
        $connection = new Database();
        $this->pdo = $connection->connect();
    }

    public function mostrarCMS() {
        try {
            $query = "SELECT * FROM `vistaCms`";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            echo "Error: " . $e->getMessage();
        }
    }

    // public static function mostrarCmsPorIdioma() {
        
    //     try {
            
    //         $query = "SELECT * FROM cms WHERE idioma = :idioma";
    //         $pdo = self::crearConexion();
    //         $stmt = $pdo->prepare($query);
    //         $stmt->bindParam(':idioma', $idioma, PDO::PARAM_STR);                
    //         $stmt->execute();
            
    //         return $stmt->fetchAll();
    //     } catch (PDOException $e) {
    //         echo "Error: " . $e->getMessage();
    //     }


    // }

    public function actualizarCms($id, $valor_politica) {
        try {        
            $query = "UPDATE `cms` 
            SET valor_politica = :valorpolitica
            WHERE id = :idcms ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':idcms', $id, PDO::PARAM_STR);
            $stmt->bindParam(':valorpolitica', $valor_politica, PDO::PARAM_STR);                
            $stmt->execute();        
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    
    public function mostrarCmsPorGrupo($idioma) {    
        try {            
            $query = "SELECT * FROM vistaTraducciones";        
            $query .= " WHERE Idioma = :idioma"; 
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':idioma', $idioma, PDO::PARAM_STR);                
            $stmt->execute();           
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$modelCms = new Cms();
?>