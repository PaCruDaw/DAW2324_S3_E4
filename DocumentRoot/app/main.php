<?php
session_start();
include("./modelos/LoginManager.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
    include ('./includes/sidebar.php');
    ?>
</head>
<body>  

<div class="content" style="margin-left: 20%;">
    <div class="grid-container">
        <div class="container text-center mt-4">
            <h1>¡Bienvenido a Artee!</h1>
            <h2>Estas son las estadísticas de <?php echo date('F')?></h2>
        </div>

        <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-6">
                
                <h2 class="mb-3">Productos Populares</h2>
                <img class="img-fluid" src="http://2.bp.blogspot.com/_QiCa_HtqEag/TBenazjFF0I/AAAAAAAAAAM/Hvp5sAJwcwE/s1600/1.jpg" alt="imagen">
               
            </div>
            <div class="col-md-6">
                <h2>Ventas mensuales </h2>
                <img class="img-fluid" src="https://mktefa.ditrendia.es/hubfs/Imagen7.png" alt="imagen2">
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-3">Ventas Anuales </h2>
                <img class="img-fluid" src="/img/estadisticas1.jpg" alt="">
            </div>
            <div class="col-md-6">
                <h2 class="mb-3">Ventas por países </h2>
                <img class="img-fluid" src="/img/estadisticas2.jpg" alt="">
            </div>
    </div>
</div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html> 