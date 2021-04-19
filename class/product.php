<?php
class Product
{

    public $db_connection;

    private $table_name = 'product';

    public $product_id;

    public $product_name;

    public $product_sku;

    public $product_short_description;

    public $product_quantity;

    public $product_description;

    public $product_image;

    public $product_price;

    public $product_status;

    public $created_at;

    public $created_by;

    public $page_start;

    public $per_page;

    public function __construct($connection)
    {

        $this->db_connection = $connection;

    }

    public function checkSkuUnique()
    {
        $where_condition = '';

        if ($this->product_id != '')
        {

            $where_condition = " and product_id != :product_id";

        }

        $check_sku_unique_query = " SELECT count(product_sku) as count  from $this->table_name where product_sku = :product_sku " . $where_condition;

        $check_sku_unique_query_prepare = $this
            ->db_connection
            ->prepare($check_sku_unique_query);

        $check_sku_unique_query_prepare->bindParam(':product_sku', $this->product_sku);

        if ($this->product_id != '')
        {

            $check_sku_unique_query_prepare->bindParam(':product_id', $this->product_id);

        }

        if ($check_sku_unique_query_prepare->execute())
        {

            $product_sku_count = $check_sku_unique_query_prepare->fetch(PDO::FETCH_OBJ);

            if ($product_sku_count->count == 0)
            {

                return true;
            }
            else
            {
                return false;
            }

        }
        else
        {
            $error = $check_sku_unique_query_prepare->errorInfo();

            return array(
                "status" => false,
                "message" => "Query failed",
                "data" => $error
            );
        }

    }

    public function prodctCreate()
    {

        $unique_account_no = $this->checkSkuUnique();

        if ($unique_account_no)
        {

            $product_create_query = " INSERT INTO $this->table_name SET product_name = :product_name , product_sku = :product_sku , product_short_description = :product_short_description, product_quantity = :product_quantity , product_description = :product_description , product_image = :product_image ,
            product_price = :product_price , product_status = :product_status, created_at = NOW(),
        created_by = :created_by ";

            $product_create_query_prepare = $this
                ->db_connection
                ->prepare($product_create_query);

            $product_create_query_prepare->bindParam(':product_name', $this->product_name);

            $product_create_query_prepare->bindParam(':product_sku', $this->product_sku);

            $product_create_query_prepare->bindParam(':product_short_description', $this->product_short_description);

            $product_create_query_prepare->bindParam(':product_quantity', $this->product_quantity);

            $product_create_query_prepare->bindParam(':product_description', $this->product_description);

            $product_create_query_prepare->bindParam(':product_image', $this->product_image);

            $product_create_query_prepare->bindParam(':product_price', $this->product_price);

            $product_create_query_prepare->bindParam(':product_status', $this->product_status);

            $product_create_query_prepare->bindParam(':created_by', $this->created_by);

            if ($product_create_query_prepare->execute())
            {

                $this->product_id = $this
                    ->db_connection
                    ->lastInsertId();

                return array(
                    "status" => true,
                    "message" => "Product added successfully",
                    "data" => $this->product_id
                );

            }
            else
            {

                $error = $product_create_query_prepare->errorInfo();

                return array(
                    "status" => false,
                    "message" => "Query failed",
                    "data" => $error
                );

            }

        }
        else
        {

            return array(
                "status" => false,
                "message" => "Duplicate Product Sku",
                "data" => ""
            );
        }

    }

    public function getProductAll()
    {

        $get_all_product_query = " SELECT p.product_id as id , p.product_name as name ,p.product_sku as sku , p.product_short_description as short_description ,p.product_quantity as quantity ,p.product_description as description , p.product_image as image , p.product_price as price , CASE WHEN p.product_status = 1 THEN 'Active' WHEN p.product_status = 2 THEN 'In Active' END as status from $this->table_name p where product_status = 1 limit   " . $this->page_start . ',' . $this->per_page;

        $get_all_product_query_prepare = $this
            ->db_connection
            ->prepare($get_all_product_query);

        if ($get_all_product_query_prepare->execute())
        {

            $products = $get_all_product_query_prepare->fetchAll(PDO::FETCH_ASSOC);

            return array(
                "status" => true,
                "message" => "Product data",
                "data" => $products
            );

        }
        else
        {

            $error = $get_product_query_prepare->errorInfo();

            return array(
                "status" => false,
                "message" => "Query failed ",
                "data" => $error
            );
        }

    }

    public function getProduct()
    {

        $get_product_query = " SELECT p.product_name as name ,p.product_sku as sku , p.product_short_description as short_description ,p.product_quantity as quantity ,p.product_description as description , p.product_image as image , p.product_price as price , p.product_status as status from $this->table_name p where product_id = :product_id ";

        $get_product_query_prepare = $this
            ->db_connection
            ->prepare($get_product_query);

        $get_product_query_prepare->bindParam(':product_id', $this->product_id);

        if ($get_product_query_prepare->execute())
        {

            $product = $get_product_query_prepare->fetch(PDO::FETCH_OBJ);

            return array(
                "status" => true,
                "message" => "Product data",
                "data" => $product
            );

        }
        else
        {

            $error = $get_product_query_prepare->errorInfo();

            return array(
                "status" => false,
                "message" => "Query failed ",
                "data" => $error
            );
        }

    }

    public function productUpdate()
    {

        $unique_account_no = $this->checkSkuUnique();

        if ($unique_account_no)
        {

            $product_update_query = " UPDATE $this->table_name SET product_name = :product_name , product_sku = :product_sku, product_short_description = :product_short_description , product_quantity = :product_quantity , product_description = :product_description , product_image = :product_image , product_price = :product_price , product_status = :product_status,
        updated_by = :updated_by where product_id = :product_id ";

            $product_update_query_prepare = $this
                ->db_connection
                ->prepare($product_update_query);

            $product_update_query_prepare->bindParam(':product_name', $this->product_name);

            $product_update_query_prepare->bindParam(':product_sku', $this->product_sku);

            $product_update_query_prepare->bindParam(':product_short_description', $this->product_short_description);

            $product_update_query_prepare->bindParam(':product_quantity', $this->product_quantity);

            $product_update_query_prepare->bindParam(':product_description', $this->product_description);

            $product_update_query_prepare->bindParam(':product_image', $this->product_image);

            $product_update_query_prepare->bindParam(':product_price', $this->product_price);

            $product_update_query_prepare->bindParam(':product_status', $this->product_status);

            $product_update_query_prepare->bindParam(':updated_by', $this->updated_by);

            $product_update_query_prepare->bindParam(':product_id', $this->product_id);

            if ($product_update_query_prepare->execute())
            {

                return array(
                    "status" => true,
                    "message" => "Product updated successfully",
                    "data" => $this->product_id
                );

            }
            else
            {

                $error = $product_update_query_prepare->errorInfo();

                return array(
                    "status" => false,
                    "message" => "Query failed",
                    "data" => $error
                );

            }

        }
        else
        {

            return array(
                "status" => false,
                "message" => "Duplicate Product Sku",
                "data" => ""
            );

        }

    }

    public function productDelete()
    {

        $product_delete_query = " DELETE from $this->table_name  where product_id = :product_id ";

        $product_delete_query_prepare = $this
            ->db_connection
            ->prepare($product_delete_query);

        $product_delete_query_prepare->bindParam(':product_id', $this->product_id);

        if ($product_delete_query_prepare->execute())
        {

            return array(
                "status" => true,
                "message" => "Product delete successfully",
                "data" => $this->product_id
            );

        }
        else
        {

            $error = $product_delete_query_prepare->errorInfo();

            return array(
                "status" => false,
                "message" => "Query failed",
                "data" => $error
            );

        }

    }

    public function productCount()
    {

        $product_count_query = " SELECT count(*) as product_count  from $this->table_name ";

        $product_count_query_prepare = $this
            ->db_connection
            ->prepare($product_count_query);

        if ($product_count_query_prepare->execute())
        {

            $product_count = $product_count_query_prepare->fetch(PDO::FETCH_OBJ);
            return array(
                "status" => true,
                "message" => "Product count",
                "data" => $product_count
            );

        }
        else
        {

            $error = $product_count_query_prepare->errorInfo();

            return array(
                "status" => false,
                "message" => "Query failed",
                "data" => $error
            );

        }
    }

}

?>
