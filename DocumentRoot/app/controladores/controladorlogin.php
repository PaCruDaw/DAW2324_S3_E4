<?php
session_start();

require_once '../modelos/UserManager.php'; // Asegúrate de incluir tu clase User


// Ejemplo de uso en tu script principal (index.php o similar)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($controlUsers->checkCredentials($username, $password)) {
        // Credenciales válidas
        $_SESSION['username'] = $username;
        header('Location: ../main.php');
        
    } else {
        
        // Credenciales incorrectas
        header('Location: ../index.php?fallo=true');

    }
    
}

?>
