<?php

session_start();

require_once '/var/www/html/modelos/modelotraducciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['traduccion_id'])){
        $idtraduccion = $_POST['traduccion_id'];
        $nuevatraduccion = $_POST['nueva_traduccion'];
        $instanciatraduccion = new Traducciones($idtraduccion,null,null,$nuevatraduccion);
        $instanciatraduccion->actualizarTraducciones();
        $traducciones=Traducciones::mostrarTraducciones();
    }

}
?>