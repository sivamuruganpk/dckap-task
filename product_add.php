<form name="product_form" id=product_form enctype="multipart/form-data">
  <div class="form-group">
    <label for="product_name">Name:</label>
    <input type="text" class="form-control mandatory-field" id="product_name" placeholder="Enter product name" name="product_name">
  </div>

  <div class="form-group">
    <label for="product_sku">SKU:</label>
    <input type="text" class="form-control mandatory-field" id="product_sku" placeholder="Enter product sku" name="product_sku" onblur="checkSkuUnique(this)">
  </div>
  <span style="display: none; color: red;font-weight: bold;" id="product_sku_mandatory">*Duplicate Sku</span>
  <div class="form-group">
    <label for="product_short_description">Shourt description:</label>
    <textarea class="form-control mandatory-field" rows="3" id="product_short_description" name="product_short_description" placeholder="Enter product short description"></textarea>
  </div>
  <div class="form-group">
    <label for="product_quantity">Quantity:</label>
    <input type="number" class="form-control mandatory-field" id="product_quantity" placeholder="Enter product quantity" name="product_quantity">
  </div>
  <div class="form-group">
    <label for="product_description">Description:</label>
    <textarea class="form-control mandatory-field" rows="3" id="product_description" name="product_description" placeholder="Enter product description"></textarea>
  </div>
  <div class="form-group">
    <label for="product_image">Image:</label>
    <input type="file" class="form-control mandatory-field" id="product_image" placeholder="Enter product image" name="product_image" onchange="fileValidate(this)">
  </div>
    <span style="display: none; color: red;font-weight: bold;" id="product_image_file_type">*Invalid type.Please upload only image</span>
  <div class="form-group">
    <label for="product_price">Price:</label>
    <input type="text" class="form-control mandatory-field" id="product_price" placeholder="Enter product price" name="product_price"> </div>
  <div class="form-group">
    <label for="product_price">Status:</label>
    <div class="radio">
      <label>
        <input type="radio" class="mandatory-field" name="product_status" id="product_active" value="1">Active</label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" class="mandatory-field" name="product_status" id="product_deactive" value="2">Deactive</label>
    </div>
  </div>
  <button type="button" class="btn btn-success" onclick="productCreate()">Submit</button>
  <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
</form>
