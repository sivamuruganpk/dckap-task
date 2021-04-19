<?php
include 'class/database.php';

include 'class/product.php';

$database = new Database();

$connection = $database->getConnection();

$product = new Product($connection);

$product_sku = $_POST['product_sku'];

$product_id = $_POST['product_id'];

$product->product_sku = $product_sku;

$product->product_id = $product_id;

echo $product_count_data = $product->checkSkuUnique();

?>
