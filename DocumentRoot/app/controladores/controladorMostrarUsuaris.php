<?php
session_start();
include('../db.php');
include('../modelos/modelUsuaris.php');

$usuarios = $modelUsuaris->obtenerTodosLosUsuarios();
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
echo json_encode($usuarios);


?>
