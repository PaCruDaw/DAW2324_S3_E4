<?php
include('../db.php');
include('../modelos/modelocms.php');


if ($_SERVER['REQUEST_METHOD']) {

    $idClient = $_POST['idClientU'];
    $name = $_POST['nameU'];
    $surname = $_POST['surnameU'];
    $username = $_POST['usernameU'];
    $password = $_POST['passwordU'];
    $mail = $_POST['emailU'];
    $phone = $_POST['phoneU'];
    $address = $_POST['addressU'];
    $postcode = $_POST['postcodeU'];
    $idCountry = $_POST['idCountryU'];
    $clientStatus = $_POST['clientStatusU'];
    $modelUsuaris->actualizarUsuario($idClient, $name, $surname, $username, $password, $mail, $phone, $address, $postcode, $idCountry, $clientStatus);          

}  
?>