<?php 
session_start();
<<<<<<< HEAD
if (isset($_SESSION['username'])) {

=======
require_once("../includes/head.php");
>>>>>>> main
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
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
        <table class="table table-striped" style="margin-top:3%;" id="productsTable">
            <thead>
                <tr>
                    <th>Id Producto</th>
                    <th>Id Variante</th>
                    <th>Producto</th>
                    <th>Tamaño</th>
                    <th>formato_anchura</th>
                    <th>formato_altura</th>
                    <th>Moneda</th>
                    <th>showProduct</th>
                    <th>Porcentaje Beneficio</th>
                </tr>
            </thead>
            <tbody>
                
                         <!-- echo "<td>" . $product['marginPercentage'] . "</td>";
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
                 } -->
            </tbody>
        </table>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="../js/table_products.js"></script>

</body>
</html>


<?php
} else {
?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=accessDenied.html">
<?php
}

?>
