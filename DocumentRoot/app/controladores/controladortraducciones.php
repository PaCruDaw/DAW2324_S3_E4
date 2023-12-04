<?php

session_start();

require_once '../modelos/modelotraducciones.php';

class ControladorTradu {

    private $traducir;

    public function __construct($traduct) {
        $this->traducir = $traduct;
    }
    
    public function actualitzarTraduc($nuevatraduccion, $idtraduccion) {
        $this->traducir->actualizarTraducciones($nuevatraduccion, $idtraduccion);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['traduccion_id'])){
        $idtraduccion = $_POST['traduccion_id'];
        $nuevatraduccion = $_POST['nueva_traduccion'];
        $traductor->actualizarTraducciones($nuevatraduccion, $idtraduccion);
?>
    <meta http-equiv="refresh" content="0;url=../vistas/vistatraducciones.php">
<?php
    }
} else {
    $traduccion = $traductor->mostrarTraducciones();
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
    echo json_encode($traduccion);
}



?>