<?php
include 'class/database.php';

include 'class/product.php';

$database = new Database();

$connection = $database->getConnection();

$product = new Product($connection);

$product_image_dir = "product_images/";

$product_image_file = $product_image_dir . basename($_FILES["product_image"]["name"]);

$product_image_file_type = strtolower(pathinfo($product_image_file, PATHINFO_EXTENSION));

$allowes_type = array(
    "jpg",
    "png",
    "jpeg",
    "gif",
    "jfif"
);

if (in_array($product_image_file_type, $allowes_type))
{

    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $product_image_file))
    {

        $product->product_name = $_POST['product_name'];

        $product->product_sku = $_POST['product_sku'];

        $product->product_short_description = $_POST['product_short_description'];

        $product->product_quantity = $_POST['product_quantity'];

        $product->product_description = $_POST['product_description'];

        $product->product_image = $product_image_file;

        $product->product_price = $_POST['product_price'];

        if ($_POST['product_status'] == '')
        {
            $product->product_status = 1;
        }
        else
        {
            $product->product_status = $_POST['product_status'];
        }

        $product->created_by = 1;

        $product_create = $product->prodctCreate();

        echo json_encode($product_create);

    }
    else
    {
        echo json_encode(array(
            "status" => false,
            "message" => "Image upload failed",
            "data" => []
        ));
    }

}
else
{
    echo json_encode(array(
        "status" => false,
        "message" => "Only JPG, JPEG, PNG & GIF files are allowed.",
        "data" => []
    ));
}

?>
