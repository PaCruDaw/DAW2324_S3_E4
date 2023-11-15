<?php
// Configuración de la base de datos
$db_host = 'mariadb';
$db_user = 'super';
$db_pass = 'super';
$db_name = 'testdatabase';


try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error de conexión a la base de datos: " . $e->getMessage();
    }
    
?>