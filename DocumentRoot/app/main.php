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
                <canvas id="chart1"></canvas>
               
            </div>
            <div class="col-md-6">
                <h2>Ventas mensuales</h2>
                <canvas id="chart2"></canvas>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-3">Ventas Anuales </h2>
                <canvas id="chart3"></canvas>
            </div>
            <div class="col-md-6">
                <h2 class="mb-3">Ventas por países </h2>
                <canvas id="chart4"></canvas>
            </div>
    </div>
</div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/js/grafiques.js"></script>
</body>
</html> 