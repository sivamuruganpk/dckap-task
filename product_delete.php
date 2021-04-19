<?php
include 'class/database.php';

include 'class/product.php';

$database = new Database();

$connection = $database->getConnection();

$product = new Product($connection);

$product_id = $_POST['product_id'];

$product->product_id = $product_id;

$product_delete = $product->productDelete();

echo json_encode($product_delete);
?>
