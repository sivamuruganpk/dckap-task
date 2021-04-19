<?php
 include 'header.php';

include 'class/database.php';

include 'class/product.php';

$database = new Database();

$connection = $database->getConnection();

$product = new Product($connection);

$product_count_data = $product->productCount();

$product_count_status = $product_count_data['status'];

$product_count_message = $product_count_data['message'];

$product_count = $product_count_data['data'];

$limit = 10;

$total_products = $product_count->product_count;

$total_pages = ceil($total_products / $limit);

?>
<body>

<div class="container">
  <h2>Products</h2>
  <input type="hidden" name="page_per_page" id="page_per_page" value="<?php echo $limit; ?>">
     <button type="button" class="btn btn-primary" style="float: right;" onclick="ProductAdd()">Add</button>

   <div id=product_list>  
    <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Sku</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="product_lists">

    </tbody>
  </table>
</div>   


<ul class="pagination">
  <?php for ($i = 1;$i < $total_pages;$i++)
{ ?>

  <li><a href="#" onclick="getAllProduct('<?php echo $i ?>')"><?php echo $i; ?></a></li>

  <?php
} ?>
</ul> 

</div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="js/product.js"></script>


  <div class="modal fade" id="product_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="product_title">Add Product</h4>
        </div>
        <div class="modal-body" id="product_info">

        </div>


      </div>
      
    </div>
  </div>
