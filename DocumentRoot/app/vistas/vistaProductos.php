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
                    <th>Nombre del Producto</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Margen Porcentaje</th>
                    <th>Acciones</th>
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
                        echo "<td>" . $product['id'] . "</td>";
                        echo "<td>" . $product['nombre_producto'] . "</td>";
                        echo "<td>" . $product['decripcion_producto'] . "</td>";
                        echo "<td>" . $product['precio'] . "</td>";
                        echo "<td>" . $product['margen_porcentaje'] . "</td>";

                        echo "<td> 
                            <form method='post' action='./controladores/controladorProductos.php' class='form-inline'>
                                <input type='hidden' name='action' value='update'>
                                <input type='hidden' name='id' value=" . $product['id'] .">
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
