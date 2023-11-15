<?php
session_start();

// Incluir el modelo de productos
include('../modelos/modeloProducto.php');

// Crear una instancia de la clase Product
$product = new Product();


// Manejar la actualización de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update']) && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion_producto = $_POST['decripcion_producto'];
    $precio = $_POST['precio'];
    $margen_porcentaje = $_POST['margen_porcentaje'];

    // Llamar al método de actualización del modelo
    $result = $product->updateProduct($id_producto);

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
