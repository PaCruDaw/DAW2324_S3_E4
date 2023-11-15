<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../includes/sidebar.php"); ?>
    <title>Estadísticas</title>
</head>
<style>
        body {
            background-color: #f8f9fa; /* Set your desired background color */
        }
    </style>
<body>
    <div class="content" style="width:80%; margin-left:20%; display:flex; flex-direction:column;">
        <div class="titulo">
            <h1>Estadisticas</h1>
        </div>
        
        <div style="margin-top:3%;"> 
        <div class="container-sm text-center" class="table-responsive">
        <h3>Productos Mensuales</h3>    
            <table class="table table-bordered table-sm mx-auto">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Ventas Mensuales</th>
                        <th>Ingresos Mensuales</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                        <td>Tazas</td>
                        <td>150</td>
                        <td>10,000 euros</td>
                    </tr>
                    <tr>
                        <td>Cojines</td>
                        <td>120</td>
                        <td>8,000 euros</td>
                    </tr>
                    <tr>
                        <td>Tarjetas de Regalo</td>
                        <td>90</td>
                        <td>6,000 euros</td>
                    </tr>
                    <tr>
                        <td>Pósters</td>
                        <td>190</td>
                        <td>16,000 euros</td>
                    </tr>
                    <tr>
                        <td>Fundas de Teléfono</td>
                        <td>100</td>
                        <td>16,000 euros</td>
                    </tr>
                    <tr>
                        <td>Gorras Bordadas</td>
                        <td>190</td>
                        <td>18,000 euros</td>
                    </tr>
                    <tr>
                        <td>Cuadernos Personalizados</td>
                        <td>190</td>
                        <td>18,000 euros</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container-sm text-center">
        <h3>Ventas</h3>
        <div class="table-responsive">
            <!-- Aplicación de clases de Bootstrap a la segunda tabla -->
            <table class="table table-bordered table-sm mx-auto">
                <thead>
                    <tr>
                        <th>Nombre Empleado</th>
                        <th>Ventas Mensuales</th>
                        <th>Ventas Anuales</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Anna Ramirez</td>
                        <td>150</td>
                        <td>100,000 euros</td>
                    </tr>
                    <tr>
                        <td>Jose Fernandez</td>
                        <td>12</td>
                        <td>28,000 euros</td>
                    </tr>
                    <tr>
                        <td>Fernanda Araujo</td>
                        <td>9</td>
                        <td>26,000 euros</td>
                    </tr>
                    <tr>
                        <td>Armando Fernandez</td>
                        <td>190</td>
                        <td>36,000 euros</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
