<?php
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Headers: *");

header('Content-Type: application/json');

header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

$header = apache_request_headers();

$data = file_get_contents('php://input');

$inputData = json_decode($data);

include '../class/database.php';

include '../class/product.php';

$database = new Database();

$connection = $database->getConnection();

$product = new Product($connection);

if($inputData->Dckap_token == "xfsdhkosaud8isandfdshy98adekjakjm"){

	$product->page_start = $inputData->page_start;

$product->per_page = $inputData->per_page;

$product_data = $product->getProductAll();

echo json_encode($product_data);

}else{
echo json_encode(array("status" => false,"message" =>"Invalid token"));

}



