<?php

session_start();

require_once '../modelos/modelotraducciones.php';

if (($_SERVER['REQUEST_METHOD'] === 'POST')) {
    
    if(isset($_POST['idioma'])){
        if (!$_POST['idioma'] == null){
            $idioma = $_POST['idioma'];
            $traduccion = $traductor->mostrarTraduccionesPorIdioma($idioma);
        }else{
            $traduccion = $traductor->mostrarTraducciones();
        }
    }
}else{
    $traduccion = $traductor->mostrarTraducciones();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['traduccion_id'])){
        $idtraduccion = $_POST['traduccion_id'];
        $nuevatraduccion = $_POST['nueva_traduccion'];
        $instanciatraduccion->actualizarTraducciones($nuevatraduccion, $idtraduccion);
        $traduccion = $traducciones->mostrarTraducciones();
    }

}
$traduccion = $traductor->mostrarTraducciones();
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
echo json_encode($traduccion);

?>