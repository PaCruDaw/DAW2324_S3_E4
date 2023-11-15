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

    public static function crearConexion() {
        $db_host = 'mariadb';
        $db_user = 'super';
        $db_pass = 'super';
        $db_name = 'testdatabase2';
    
        try {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error de conexión a la base de datos: " . $e->getMessage();
        }
    }
    

    function agregarTraduccion() {


        //método para un futuro añadir nuevos campos que traducir
        try {

            $query = "UPDATE TraduccionIdiomas SET Traduccion = :traduccion WHERE traduccion_id = :idtextooriginal AND idiomas_id = :ididioma";
            $pdo = self::crearConexion();
            $stmt = $pdo->prepare($query);
        
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
            $query = "SELECT * FROM vistaTraducciones";
            $pdo = self::crearConexion(); // Usamos self en lugar de $this para llamar a un método estático
            $stmt = $pdo->prepare($query);
    
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            echo "Error: " . $e->getMessage();
        }
    }

    public static function mostrarTraduccionesPorIdioma($idioma) {
        try {
            
            $query = "SELECT * FROM vistaTraducciones";
            $pdo = self::crearConexion();
        
            $query .= " WHERE Idioma = :idioma"; 
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':idioma', $idioma, PDO::PARAM_STR);                
            

            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }


    }

    public function actualizarTraducciones() {
        
        try {
            $query = "UPDATE TraduccionIdiomas 
            SET `Traduccion`= :traduccion 
            WHERE ID = :idtraduccion";
            $pdo = self::crearConexion(); // Usamos self en lugar de $this para llamar a un método estático
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':traduccion',$this->traduccion, PDO::PARAM_STR);
            $stmt->bindParam(':idtraduccion', $this->idtraduccion, PDO::PARAM_STR);
            $stmt->execute();
            
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            echo "Error: " . $e->getMessage();
        }
    }


    
    

    }

?>