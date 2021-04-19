<?php
include 'class/database.php';

include 'class/product.php';

$product_id = $_POST['product_id'];

$database = new Database();

$connection = $database->getConnection();

$product = new Product($connection);

$product->product_id = $product_id;

$product_data = $product->getProduct();

$status = $product_data['status'];

$message = $product_data['message'];

$product = $product_data['data'];

?>

<form name="product_edit_form" id=product_edit_form enctype="multipart/form-data">
  <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>">
  <div class="form-group">
    <label for="product_name">Name:</label>
    <input type="text" class="form-control mandatory-field" id="product_name" placeholder="Enter product name" name="product_name" value="<?php echo $product->name ?>">
  </div>

  <div class="form-group">
    <label for="product_sku">SKU:</label>
    <input type="text" class="form-control mandatory-field" id="product_sku" placeholder="Enter product sku" name="product_sku" onblur="checkSkuUnique(this,<?php echo $product_id; ?>)"
    value="<?php echo $product->sku ?>">
  </div>
  <span style="display: none; color: red;font-weight: bold;" id="product_sku_mandatory">*Duplicate Sku</span>
  <div class="form-group">
    <label for="product_short_description">Shourt description:</label>
    <textarea class="form-control mandatory-field" rows="3" id="product_short_description" name="product_short_description" placeholder="Enter product short description"><?php echo $product->short_description ?></textarea>
  </div>
  <div class="form-group">
    <label for="product_quantity">Quantity:</label>
    <input type="number" class="form-control mandatory-field" id="product_quantity" placeholder="Enter product quantity" name="product_quantity" value="<?php echo $product->quantity ?>">
  </div>
  <div class="form-group">
    <label for="product_description">Description:</label>
    <textarea class="form-control mandatory-field" rows="3" id="product_description" name="product_description" placeholder="Enter product description"><?php echo $product->short_description ?></textarea>
  </div>
  <div class="form-group">
    <label for="product_image">Image:</label>
    <input type="file" class="form-control" id="product_image" placeholder="Enter product image" name="product_image" value="<?php echo $product->image ?>" onchange="fileValidate(this)">
  </div>
  <img src="<?php echo $product->image ?>" id="edit_image_show" width="100px" height="100px">
  <input type="hidden" class="form-control" id="product_image_clone" placeholder="Enter product image" name="product_image_clone" value="<?php echo $product->image ?>">
  <div class="form-group">
    <label for="product_price">Price:</label>
    <input type="text" class="form-control mandatory-field" id="product_price" placeholder="Enter product price" name="product_price" value="<?php echo $product->price ?>"> </div>
  <div class="form-group">
    <label for="product_price">Status:</label>
    <div class="radio">
      <label>
        <input type="radio" class="mandatory-field" name="product_status" id="product_active" value="1" <?php if ($product->status == 1) echo "checked"; ?>>Active</label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" class="mandatory-field" name="product_status" id="product_deactive" value="2" <?php if ($product->status == 2) echo "checked"; ?>>Deactive</label>
    </div>
  </div>
  <button type="button" class="btn btn-success" onclick="productUpdate('<?php echo $product_id; ?>')">Submit</button>
  <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
</form>
