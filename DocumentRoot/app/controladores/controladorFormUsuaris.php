<?php
include('../db.php');
include('../modelos/modelUsuaris.php');

//$modelUsuaris->agregarUsuario(1,'pepe3','surname pepe3','user pepe3','pass pepe3','pepe3@pepe.pepe',1,'adress pepe3',1,1);
//$modelUsuaris->actualizarUsuario(5,1,'pepe update','surname pepe3 update','user pepe3 update','pass pepe3 update','pepe3update@pepe.pepe',1,'adress pepe3 update',1,1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $accion = $_POST['action'];
     
    switch ($accion) {
        case "update":
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
            break;

        case "add":
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $mail = $_POST['mail'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $postcode = $_POST['postcode'];
            $idCountry = $_POST['idCountry'];
            $clientStatus = $_POST['clientStatus'];
            $modelUsuaris->agregarUsuario($name, $surname, $username, $password, $mail, $phone, $address, $postcode, $idCountry, $clientStatus );          
            break;

        default:
            // Acción predeterminada si no se encuentra ninguna acción válida
            echo "Acción no válida";
            break;
    }
    

}  
?>