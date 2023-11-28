<?php
require_once 'database.php';

class Traducciones {
   
    private $pdo;

    public function __construct()
    {
        $connection = new Database();
        $this->pdo = $connection->connect();
    }

    function agregarTraduccion($idtextooriginal,$traduccion,$ididioma) {
        //método para un futuro añadir nuevos campos que traducir
        try {

            $query = "UPDATE TraduccionIdiomas SET Traduccion = :traduccion 
                        WHERE traduccion_id = :idtextooriginal AND idiomas_id = :ididioma";
            $stmt = $this->pdo->prepare($query);
        
            // Enlazar los parámetros
            $stmt->bindParam(':idtextooriginal', $idtextooriginal, PDO::PARAM_STR);
            $stmt->bindParam(':traduccion', $traduccion, PDO::PARAM_STR);
            $stmt->bindParam(':ididioma', $ididioma, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            echo "Error: " . $e->getMessage();
        }
    }

    public function mostrarTraducciones() {
        try {
            $query = "SELECT * FROM vistaTraducciones";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            echo "Error: " . $e->getMessage();
        }
    }

    public function mostrarTraduccionesPorIdioma($idioma) {
        try {
            $query = "SELECT * FROM vistaTraducciones
                     WHERE Idioma = :idioma"; 
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':idioma', $idioma, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function actualizarTraducciones($traduccion,$idtraduccion) {
        try {
            $query = "UPDATE TraduccionIdiomas 
                        SET `Traduccion`= :traduccion 
                        WHERE ID = :idtraduccion";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':traduccion',$traduccion, PDO::PARAM_STR);
            $stmt->bindParam(':idtraduccion', $idtraduccion, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            echo "Error: " . $e->getMessage();
        }
    }
}
//create instansce
$traductor = new Traducciones();
?>