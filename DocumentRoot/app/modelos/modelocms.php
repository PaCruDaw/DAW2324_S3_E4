<?php

    class ModelCms {
        private $pdo;
    
        public function __construct($pdo) {
            $this->pdo = $pdo;
        }
    
        public function mostrarCms() {
            $query = "SELECT * FROM cms";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function obtenerCmsPorId($idCms) {
            $query = "SELECT * FROM cms WHERE idCms = :idCms";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':idCms', $idCms, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
    
        public function actualizarCms($idCms, $policyValue) {
            $query = "UPDATE `cms` SET `policyValue`= :policyValue
            WHERE idCms = :idCms";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':idCms', $idCms, PDO::PARAM_INT);
            $stmt->bindParam(':policyValue', $policyValue, PDO::PARAM_STR);
            $stmt->execute();
        }
    
    }
    
    $modelCms = new ModelCms($pdo);

?>