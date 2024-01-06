<?php
session_start();

// Incluir el modelo de productos
include('../modelos/modeloProducto.php');

// Crear una instancia de la clase Product
$product = new Product();


// Manejar la actualización de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update']) && isset($_POST['idProduct'])) {
    $idVariant = $_POST['idVariant'];
    $idProduct = $_POST['idProduct'];
    $size = $_POST['size'];
    $variantName = $_POST['variantName'];
    $margen_porcentaje = $_POST['marginPercentage'];
    $format_width = $_POST['format_width'];
    $format_height = $_POST['format_height'];
    $currency = $_POST['currency'];
    $accion = $_POST['showProduct'];

    // Llamar al método de actualización del modelo
    $result = $product->updateProduct($idProduct);

    if ($result) {
        // Producto actualizado exitosamente
        echo("funciono");
        header('Location: ./vistas/vistaProductos.php'); // Redirigir a la misma página después de la actualización
        exit();
    } else {
    // Ocurrió un error al actualizar el producto
        echo "Error al actualizar el producto.";
    }
}




?>
