<?php
include('../modelos/modeloProducto.php');
$products = $product->getProducts();
echo json_encode($products);


