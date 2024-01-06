<?php
class PreferenceManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getPreferences() {
        $query = "SELECT * FROM configurations";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePreferenceValueByName($nombre, $nuevoValor) {
        $query = "UPDATE configurations SET value = :nuevoValor WHERE config = :nombre";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':nuevoValor', $nuevoValor, PDO::PARAM_STR);
    
        return $stmt->execute();
    }
    
}
?>
