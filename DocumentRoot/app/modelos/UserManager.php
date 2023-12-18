<?php

class AdministradorUsuarios {
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

   

    public function agregarUsuario($datosUsuario) {
        $query = "INSERT INTO usuario (nombre, apellido, email, contrasena, username, es_admin, fecha_alta, estado_id) 
              VALUES (:nombre, :apellido, :email, :contrasena, :username, :es_admin, NOW(), 1)";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute($datosUsuario);

    return $this->pdo->lastInsertId();
    }

    public function actualizarUsuario($datosUsuario) {
        $query = "UPDATE usuario 
                  SET nombre = :nombre, apellido = :apellido, email = :email, 
                      contrasena = :contrasena, username = :username, es_admin = :es_admin 
                  WHERE id = :idUsuario";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        return $stmt->execute($datosUsuario);
    }

    public function eliminarUsuario($idUsuario) {
        $query = "DELETE FROM usuario WHERE id = :idUsuario";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

?>
