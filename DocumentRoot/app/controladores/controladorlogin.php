<?php
include("../modelos/LoginManager.php");
class Login{
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function processLogin($email, $password) {
        if ($this->user->login($email, $password)) {
            $this->startSession();
            $this->redirectUser();
        } else {
            $this->displayErrorMessage("Ingrese un usuario y contraseña correctos");
        }
    }

    //almacena información del usuario
    private function startSession() {
        session_start();
        $_SESSION['id'] = $this->user->getId();
        $_SESSION['email'] = $this->user->getEmail();
        $_SESSION['es_admin'] = $this->user->getEsAdmin();
        $_SESSION['username'] = $this->user->getUsername();
    }

    private function redirectUser() {
        header("Location: ../main.php");
        exit;
    }

    private function displayErrorMessage($message) {
        echo $message;
    }
}


if(isset($_POST['email'])){
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    //creo objeto de Login controller que crea un objeto basado en la clase usuario
    $login = new Login();
    $login->processLogin($email, $password);
} else {
    echo "Error en la conexión de la base de datos";
}
}


?>
