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
    public function insertOriginalText($text, $site) {
        try {
            $this->pdo->beginTransaction();  // Iniciar la transacción

            $query = "INSERT INTO Traduccion (TextoOriginal, site) VALUES (:text, :site)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':site', $site);
            $stmt->execute();
    
            // Obtener el último ID insertado directamente
            $lastInsertId = $this->pdo->lastInsertId();
    
            $this->pdo->commit();  // Confirmar la transacción
    
            return $lastInsertId;  // Devolver el ID del último registro insertado
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    //Search and count all languages present in a DB
    public function countLanguages () {
        $query = "SELECT COUNT(*) FROM Idiomas;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $resultat = $stmt->fetchColumn();
        return (int) $resultat;
    }

    //This function is for create in DB a new translate, the translate is create automaticaly and use 
    //the same value of text for insert
    public function insertTranslate ($text, $id_translate, $id_lang) {
        try {
            $query = "INSERT INTO TraduccionIdiomas (Traduccion, traduccion_id , idiomas_id )
                       VALUES (:text, :id_translate, :id_lang)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':text', $text);
            $stmt->bindParam(':id_translate', $id_translate);
            $stmt->bindParam(':id_lang', $id_lang);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //Search a test in a site(Page view), this is use to make translate
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
            $exist = $this->searchTextOriginal($text, $site); //return assosiative array with one row
            if (isset($exist[0]['TextoOriginal'])) {
                return $exist[0]['TextoOriginal'];
            } else {
                $id_trans = $this->insertOriginalText($text,$site);
                $n_lang = $this->countLanguages();
                var_dump($n_lang);
                for ($i =1; $i <= $n_lang; $i++) {
                    $this->insertTranslate ($text, $id_trans, $i);
                } 
                

            }         
        
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
//create instansce
$traductor = new Traducciones();
$traductor->translatePage('Traduccions',"sidebar");
?>