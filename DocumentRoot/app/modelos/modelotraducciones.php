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

    //this function is for create in a DB a new text for translate
    public function insertOriginalText ($text) {
        try {
            $query = "INSERT INTO  Traduccion (TextoOriginal)
                        VALUES $text";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function countLanguages () {

    }

    //This function is for create in DB a new translate, the translate is create automaticaly and use 
    //the same value of text for insert
    public function insertTranslate ($text, $site) {
        try {
            $query = "START TRANSACTION;
                        INSERT INTO  Traduccion (TextoOriginal, site) VALUES '$text', '$site';
                        SELECT LAST_INSERT_ID();
                      COMMIT;";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function searchTextOriginal ($text, $site) {
        $query = "SELECT TextoOriginal
                    FROM Traduccion
                    WHERE site = :site AND TextoOriginal = :text";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':text',$text, PDO::PARAM_STR);
        $stmt->bindParam(':site',$site, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //This function is for translate a page, site is the site where is generate the text to translate, 
    // and text is new text for translate 
    public function translatePage ($text, $site) {
        try {
            $exist = $this->searchTextOriginal($text, $site);
            $exist[0]['TextoOriginal'];
            
        
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
//create instansce
$traductor = new Traducciones();
$traductor->translatePage('Hola','');
?>