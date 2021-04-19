<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include 'class/utility.php';

$utility = new Utility();

$limit = $_POST['limit'];

$per_page = $_POST['page_per_page'];

if ($limit == '')
{
    $page = 1;
}
else
{
    $page = $limit;
}

$page_first_result = ($page - 1) * $per_page;

$url = 'http://localhost/Dckap-product/rest-api/product_list.php';

$data['page_start'] = $page_first_result;

$data['per_page'] = $per_page;

$data['Dckap_token'] = "xfsdhkosaud8isandfdshy98adekjakjm";

$product_lists = json_decode($utility->curlPost($url, $data));

$status = $product_lists->status;

$message = $product_lists->message;

$products = $product_lists->data;

if($status){

  if (empty($products)){ ?>
    <tr>
<td colspan="9" class="no-record-found text-center">No record found. </td>
  </tr>
<?php
}
else
{
    $index = 1;
    foreach ($products as $key => $product)

    { ?>
    <tr>
      <td><?php echo $index ?></td>
      <td><?php echo $product->name ?></td>
      <td><img src="<?php echo $product->image ?>" width="100px" height="100px" alt="<?php echo $product->image ?> Product image"></td>
      <td><?php echo $product->price ?></td>
      <td><?php echo $product->sku ?></td>
      <td><?php echo $product->quantity ?></td>
      <td><?php echo $product->status ?></td>
      <td><?php echo $product->description ?></td>
      <td>
<button type="button" class="btn btn-primary" onclick="productEdit('<?php echo $product->id ?>')">Edit</button>
<button type="button" class="btn btn-primary" onclick="productDelete('<?php echo $product->id ?>')">Delete</button>
      </td>


    </tr>

 <?php
        $index++;
    }
}

}else{ ?>
    <tr>
<td colspan="9" class="no-record-found text-center"><?php echo $message; ?></td>
  </tr>
<?php } ?>
