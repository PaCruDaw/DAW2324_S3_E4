<?php

class ModelUsuaris {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerTodosLosUsuarios() {
        $query = "SELECT * FROM usuario";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioPorId($idUsuario) {
        $query = "SELECT * FROM usuario WHERE id = :idUsuario";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarUsuario($nombre, $apellido, $email, $contrasena, $username, $esadmin, $estado_id) {
        $query = "INSERT INTO `usuario`( `nombre`, `apellido`, `email`, `contrasena`, `username`, `es_admin`, `estado_id`) 
        VALUES (:nombre,:apellido,:email,:contrasena,:username,:esadmin,:estado_id)";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':esadmin', $esadmin, PDO::PARAM_INT);
    $stmt->bindParam(':estado_id', $estado_id, PDO::PARAM_INT); 
    $stmt->execute();

    }

    public function actualizarUsuario($nombre,$apellido,$email,$contrasena,$username,$esadmin,$estadoid,$idusuario) {
        $query = "UPDATE `usuario` SET `nombre` = :nombre, `apellido` = :apellido, `email` = :email,
         `contrasena` = :contrasena, `username` = :username, `es_admin` = :esadmin,
          `estado_id` = :estado_id WHERE usuario.id = :idusuario";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':esadmin', $esadmin, PDO::PARAM_INT);
        $stmt->bindParam(':estado_id', $estadoid, PDO::PARAM_INT);
        $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
        $stmt->execute();
    }

}

$modelUsuaris = new ModelUsuaris($pdo);

?>
