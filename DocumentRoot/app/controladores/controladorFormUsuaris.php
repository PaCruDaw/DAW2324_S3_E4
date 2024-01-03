<?php
include('../db.php');
include('../modelos/modelUsuaris.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['idUsuarioU'])){
        
    $idUsuario = $_POST['idUsuarioU'];
    $nombre = $_POST['nombreU'];
    $apellido = $_POST['apellidoU'];
    $email = $_POST['emailU'];
    $contrasena = $_POST['contrasenaU'];
    $username = $_POST['usernameU'];
    $es_admin = $_POST['es_adminU'];
    $modelUsuaris->actualizarUsuario($nombre, $apellido, $email, $contrasena, $username, $es_admin, 1, $idusuario);
    
    }else{

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $username = $_POST['username'];
    $es_admin = $_POST['es_admin'];
    $modelUsuaris->agregarUsuario($nombre, $apellido, $email, $contrasena, $username, $es_admin, 1 );
    }  
    
}
?>