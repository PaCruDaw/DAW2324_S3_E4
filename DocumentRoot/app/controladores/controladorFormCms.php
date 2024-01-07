<?php
include('../db.php');
include('../modelos/modelocms.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idCms = $_POST['idCms'];
    $policyValue = $_POST['policyValue'];
    $modelCms->actualizarCms($idCms, $policyValue);          

}  
?>