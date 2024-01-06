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
        $query = "SELECT * FROM client WHERE idClient = :idClient";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarUsuario($idstatus, $name, $surnames, $username, $password, $mail, $phone, $address, $postcode, $idCountry) {
        $query = "INSERT INTO `clients`( `idCS`, `name`, `surnames`, `username`, `password`, `mail`, `phone`,`address`,`postcode`,`idCountry`) 
        VALUES (:idCS,:name,:surnames,:username,:password,:mail,:phone,:address,:postcode,:idCountry)";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':idCS', $idstatus, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':surnames', $surnames, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_INT); 
    $stmt->bindParam(':address', $address, PDO::PARAM_STR); 
    $stmt->bindParam(':postcode', $postcode, PDO::PARAM_INT); 
    $stmt->bindParam(':idCountry', $idCountry, PDO::PARAM_INT);  
    $stmt->execute();

    }

    public function actualizarUsuario($idClient, $idstatus, $name, $surnames, $username, $password, $mail, $phone, $address, $postcode, $idCountry) {
        $query = "UPDATE `clients` SET `idCS`= :idCS,`name`= :name,`surnames`= :surnames, `username`= :username,
        `password`= :password ,`mail`= :mail,`phone`= :phone,`address`= :address,`postcode`= :postcode ,`idCountry`= :idCountry 
        WHERE idClient = :idClient";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
        $stmt->bindParam(':idCS', $idstatus, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surnames', $surnames, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_INT); 
        $stmt->bindParam(':address', $address, PDO::PARAM_STR); 
        $stmt->bindParam(':postcode', $postcode, PDO::PARAM_INT); 
        $stmt->bindParam(':idCountry', $idCountry, PDO::PARAM_INT); 
        $stmt->execute();
    }

}

$modelUsuaris = new ModelUsuaris($pdo);

?>
