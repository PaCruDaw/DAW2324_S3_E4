<?php
class Cms {
    
    public $id;
    public $politica;
    public $valor_politica;

    

    public function __construct ($id, $politica ,$valor_politica) {

        $this->id = $id;
        $this->politica = $politica;
        $this->valor_politica = $valor_politica;
        
    
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
    

    public static function mostrarCMS() {
        
        try {
            $query = "SELECT * FROM `vistaCms`";
            $pdo = self::crearConexion(); // Usamos self en lugar de $this para llamar a un método estático
            $stmt = $pdo->prepare($query);
    
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

    public function actualizarCms() {
        
        try {
            
            $query = "UPDATE `cms` 
            SET valor_politica = :valorpolitica
            WHERE id = :idcms ";
            $pdo = self::crearConexion();
    
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':idcms', $this->id, PDO::PARAM_STR);                
            $stmt->bindParam(':valorpolitica', $this->valor_politica, PDO::PARAM_STR);                
            $stmt->execute();
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }


    }
    
    
    public static function mostrarCmsPorGrupo($idioma) {
        
        try {
            
            $query = "SELECT * FROM vistaTraducciones";
            $pdo = self::crearConexion();
        
            $query .= " WHERE Idioma = :idioma"; 
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':idioma', $this->idioma, PDO::PARAM_STR);                
            

            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }


    }

    
    

    }

?>