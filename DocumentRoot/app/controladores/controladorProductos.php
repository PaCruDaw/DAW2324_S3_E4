<?php
include('../modelos/modeloProducto.php');
$product = new Product();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idVariant']) && isset($_POST['showProduct'])) {
    $idVariant = $_POST['idVariant'];
    $showProduct = $_POST['showProduct'];

    $result = $product->updateAction($idVariant, $showProduct);

    if ($result) {
        echo json_encode(['result' => $result]);
        exit();
    } else {
        echo json_encode(['error' => 'Error al actualizar el estado']);
        exit();
    }
} else {

$data = $product->getProducts();
echo json_encode(['data' => $data]);
}
?>