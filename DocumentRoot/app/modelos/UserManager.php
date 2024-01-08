<?php
require_once 'database.php';

class Users {
    private $pdo;

    public function __construct() {
        $connection = new Database();
        $this->pdo = $connection->connect();
    }

    public function obtenerTodosLosUsuarios() {
        $query = "SELECT * FROM users";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkCredentials($name, $password) {
        $query = "SELECT * FROM users WHERE name = :name and password = :password";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $stmt->execute();
        $result =$stmt->fetchAll(PDO::FETCH_ASSOC);

        // Verificar si se encontró el usuario
        if ($result) {
            return true; // Las credenciales son válidas
        } else {
            return false;
        }
    }
}
$controlUsers = new Users();

?>
