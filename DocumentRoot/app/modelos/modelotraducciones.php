<?php
class Traducciones {
    
    public $idtraduccion;
    public $idtextooriginal;
    public $ididioma;
    public $traduccion;
    

    public function __construct ($idtraduccion, $idtextooriginal, $ididioma, $traduccion) {

        $this->idtraduccion = $idtraduccion;
        $this->idtextooriginal = $idtextooriginal;
        $this->ididioma = $ididioma;
        $this->traduccion = $traduccion;
    
    }

    public function agregarTraduccion($idtextooriginal,$traduccion,$ididioma) {
        //método para un futuro añadir nuevos campos que traducir
        try {

            $query = "UPDATE translations SET translation = :traduccion 
                        WHERE idTranslation = :idtextooriginal AND idLanguages = :ididioma";
            $stmt = $this->pdo->prepare($query);
        
            // Enlazar los parámetros
            $stmt->bindParam(':idtextooriginal', $this->$idtextooriginal, PDO::PARAM_STR);
            $stmt->bindParam(':traduccion', $this->$traduccion, PDO::PARAM_STR);
            $stmt->bindParam(':ididioma', $this->$ididioma, PDO::PARAM_STR);
            
            $stmt->execute();

        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            echo "Error: " . $e->getMessage();
        }
    }

    public static function mostrarTraducciones() {
        try {
            $query = "SELECT * FROM viewTranslations";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            echo "Error: " . $e->getMessage();
        }
    }

    public static function mostrarTraduccionesPorIdioma($idioma) {
        try {
            $query = "SELECT * FROM viewTranslations
                     WHERE language = :idioma"; 
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':idioma', $idioma, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }


    }

    public function actualizarTraducciones() {
        
        try {
            $query = "UPDATE translations
                        SET `translation`= :traduccion 
                        WHERE idTranslation = :idtraduccion";
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

            $query = "INSERT INTO originals (originalText, site) VALUES (:text, :site)";
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
        $query = "SELECT COUNT(*) FROM languages;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $resultat = $stmt->fetchColumn();
        return (int) $resultat;
    }

    //This function is for create in DB a new translate, the translate is create automaticaly and use 
    //the same value of text for insert
    public function insertTranslate ($text, $id_translate, $id_lang) {
        try {
            $query = "INSERT INTO translations (translation, idOriginal, idLanguage)
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
        $query = "SELECT originalText
                    FROM originals
                    WHERE site = :site AND originalText = :text";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':text',$text, PDO::PARAM_STR);
        $stmt->bindParam(':site',$site, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function searchTranslate ($text, $site, $lang) {
        $query = "SELECT translation
                    FROM viewTranslations
                    WHERE  language =:lang AND originalText = :text AND  site = :site";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':text',$text, PDO::PARAM_STR);
        $stmt->bindParam(':lang',$lang, PDO::PARAM_STR);
        $stmt->bindParam(':site',$site, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //This function is for translate a page, site is the site where is generate the text to translate, 
    // and text is new text for translate
    public function translateTextPage ($text, $site,$lang) {
        try {
            $exist = $this->searchTextOriginal($text, $site); //return assosiative array with one row
            if (isset($exist[0]['originalText'])) { //if the search finds the original text
                return $this->searchTranslate ($text, $site, $lang);
            } else { 
                $id_trans = $this->insertOriginalText($text,$site); //will enter the text in the list of translations
                $n_lang = $this->countLanguages(); //will search for the languages that are available there
                for ($i =1; $i <= $n_lang; $i++) { //for all languages
                    $this->insertTranslate ($text, $id_trans, $i); //insert translation
                }
            return $this->translateTextPage ($text, $site,$lang);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
//create instansce
$traductor = new Traducciones();

?>