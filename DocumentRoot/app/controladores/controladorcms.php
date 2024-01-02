<?php

session_start();

include '../modelos/modelocms.php';

function contieneScript($texto) {
    $textoEnMinusculas = strtolower($texto);
    $posicion = stripos($textoEnMinusculas, '<script');
    return $posicion !== false;
}

function pashtml($texto){
    $a = str_replace("&","&amp",$texto);
    $b = str_replace("<","&lt",$a);
    $c = str_replace(">","&gt",$b);
    return $c;
}

$errorcms= [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['cms_id'])){
        $idcms = $_POST['cms_id'];
        $nuevocms = $_POST['nuevo_cms'];
        if(empty($nuevocms)) {
            $errorcms[$idcms] = 'Este campo no puede estar vacío';
            echo "1";
        }elseif(contieneScript($nuevocms)) {
            $errorcms[$idcms] = 'No se permiten etiquetas &ltscript&gt en el campo';
            echo "2";
        } else {
            $cmsformatado = pashtml($nuevocms);
            $errorcms[$idcms] = null;
            $instanciacms = new Cms($idcms,null,$cmsformatado);
            $instanciacms->actualizarCms();
        }       

    }   
}



$cms = Cms::mostrarCMS();



//include 'vistatraducciones.php';

include '../vistas/vistacms.php';



?>