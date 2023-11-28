<?php
include('../modelos/modeloProducto.php');

// Manejar la actualización de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nuevoMargen'])) {
    $id = $_POST['id'];
    $nuevoMargen = $_POST['nuevoMargen'];

    // Llamar al método de actualización del modelo
    $product->updateProduct($id, $nuevoMargen);

}
$products = $product->getProducts();
?>
