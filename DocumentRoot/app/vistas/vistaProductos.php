<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../includes/sidebar.php")?>
    <title>Productos</title>
</head>
<style>
        body {
            background-color: #f8f9fa; /* Set your desired background color */
        }
    </style>
<body class="container-fluid" style="width:80%; margin-left:20%; display:flex; flex-direction:column;">
    <section>
        <h1>Lista de Productos</h1>
        <table class="table table-striped" style="margin-top:3%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Producto</th>
                    <th>Tamaño</th>
                    <th>Nombre del Producto</th>
                    <th>Anchura (px)</th>
                    <th>Altura (px)</th>
                    <th>Moneda</th>
                    <th>Accion</th>
                    <th>Beneficio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../modelos/modeloProducto.php');
                $product = new Product();
                $products = $product->getProducts();

                if ($products) {
                    foreach ($products as $product) {
                        echo "<tr>";
                        echo "<td>" . $product['idVariant'] . "</td>";
                        echo "<td>" . $product['idProduct'] . "</td>";
                        echo "<td>" . $product['size'] . "</td>";
                        echo "<td>" . $product['variantName'] . "</td>";
                        echo "<td>" . $product['format_width'] . "</td>";
                        echo "<td>" . $product['format_height'] . "</td>";
                        echo "<td>" . $product['currency'] . "</td>";
                        echo "<td>" . $product['showProduct'] . "</td>";
                        echo "<td>" . $product['marginPercentage'] . "</td>";

                        echo "<td> 
                            <form method='post' action='./controladores/controladorProductos.php' class='form-inline'>
                                <input type='hidden' name='action' value='update'>
                                <input type='hidden' name='id' value=" . $product['idVariant'] .">
                                <label for='nuevoMargen' class='sr-only'>Nuevo Margen:</label>
                                <input type='number' name='nuevoMargen' id='nuevoMargen' class='form-control mr-2' required>
                                <button type='submit' class='btn btn-primary'>Editar Margen</button>
                            </form>
                        </td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron productos.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
</body>
</html>
