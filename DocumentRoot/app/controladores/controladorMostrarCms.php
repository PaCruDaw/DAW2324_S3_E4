<?php
session_start();
include('../db.php');
include('../modelos/modelocms.php');

$cms = $modelCms->mostrarCms();
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
echo json_encode($cms);

?>