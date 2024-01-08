<?php
session_start();

require_once '../modelos/UserManager.php'; // Asegúrate de incluir tu clase User

class UserControl {
    private $controlUser;
    public function __construct() {
        $this->controlUser = new Users();
    }


    public function login($username, $password) {
        if ($this->controlUser->checkCredentials($username, $password)) {
            // Credenciales válidas
            session_start();
            $_SESSION['username'] = $username;
            header('Location: ./controladores/usuarios.php?fallo=true');
            exit();
        } else {
            // Credenciales incorrectas
            echo "Usuario o contraseña incorrectos";
        }
    }
}

// Ejemplo de uso en tu script principal (index.php o similar)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $controlUser = new UserControl();
    $controlUser->login($username, $password);
    
}
?>
