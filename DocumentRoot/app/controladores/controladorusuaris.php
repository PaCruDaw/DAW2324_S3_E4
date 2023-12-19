<?php
session_start();
include('../db.php');
include('../modelos/modelUsuaris.php');


//$usuariosid  = $modelUsuaris->obtenerTodosLosUsuarios();
//$modelUsuaris->agregarUsuario("nombre", "apellido", "email" , "contrasena" , "username" , 1 , 2 );
//$modelUsuaris->actualizarUsuario("nombre", "apellido", "email" , "contrasena" , "username" , 1 , 2 , 3 );

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['idUsuario'])){
    $idUsuario = $_POST['idUsuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $username = $_POST['username'];
    $es_admin = $_POST['es_admin'];
    $modelUsuaris->agregarUsuario($nombre, $apellido, $email, $contrasena, $username, $es_admin, 1 );
    

    }else{
    
    }  
    
}

$usuarios = $modelUsuaris->obtenerTodosLosUsuarios();
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
echo json_encode($usuarios);


?>
