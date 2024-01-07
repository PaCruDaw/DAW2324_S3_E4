<?php

class ModelUsuaris {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerTodosLosUsuarios() {
        $query = "SELECT * FROM clients";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioPorId($idClient) {
        $query = "SELECT * FROM clients WHERE idClient = :idClient";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarUsuario($name, $surnames, $username, $password, $mail, $phone, $address, $postcode, $idCountry, $clientStatus) {
        $query = "INSERT INTO `clients`(`name`, `surnames`, `username`, `password`, `mail`, `phone`,`address`,`postcode`,`idCountry`, `clientStatus`) 
        VALUES (:name,:surnames,:username,:password,:mail,:phone,:address,:postcode,:idCountry,:clientStatus)";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':surnames', $surnames, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_INT); 
    $stmt->bindParam(':address', $address, PDO::PARAM_STR); 
    $stmt->bindParam(':postcode', $postcode, PDO::PARAM_INT); 
    $stmt->bindParam(':idCountry', $idCountry, PDO::PARAM_INT); 
    $stmt->bindParam(':clientStatus', $clientStatus, PDO::PARAM_STR);

    $stmt->execute();

    }

    public function actualizarUsuario($idClient, $name, $surnames, $username, $password, $mail, $phone, $address, $postcode, $idCountry, $clientStatus) {
        $query = "UPDATE `clients` SET `name`= :name,`surnames`= :surnames, `username`= :username,
        `password`= :password ,`mail`= :mail,`phone`= :phone,`address`= :address,`postcode`= :postcode ,`idCountry`= :idCountry, `clientStatus`= :clientStatus,
        WHERE idClient = :idClient";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surnames', $surnames, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_INT); 
        $stmt->bindParam(':address', $address, PDO::PARAM_STR); 
        $stmt->bindParam(':postcode', $postcode, PDO::PARAM_INT); 
        $stmt->bindParam(':idCountry', $idCountry, PDO::PARAM_INT);
        $stmt->bindParam(':clientStatus', $clientStatus, PDO::PARAM_STR); 
        $stmt->execute();
    }

}

$modelUsuaris = new ModelUsuaris($pdo);

?>
