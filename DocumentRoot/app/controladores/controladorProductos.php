<?php
include('../modelos/modeloProducto.php');

// Manejar la actualización de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nuevoMargen'])) {
        $id = $_POST['id'];
        $nuevo_margen = $_POST['nuevoMargen'];
        // Llamar al método de actualización del modelo
        $product->updateProduct($id, $nuevo_margen);
}
$products = $product->getProducts();
?>
