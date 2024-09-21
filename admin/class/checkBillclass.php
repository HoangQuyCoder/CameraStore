<?php
include "database.php";
?>

<?php
class checkBill
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert_bill($postData)
    {
        $customer_name = $this->db->link->real_escape_string($postData['customerName']);
        $products_id = $this->db->link->real_escape_string($postData['productList']);
        $quantity = (int)$postData['quantity'];
        $quantity = (int)$postData['quantity'];
        $address = $this->db->link->real_escape_string($postData['address']);
        $phone = $this->db->link->real_escape_string($postData['phone']);
        $status = (int)$postData['orderState'];
        $orderDate = $this->db->link->real_escape_string($postData['orderDate']);

        // Insert new customer
        $insertCustomerQuery = "INSERT INTO customer (customer_name, address, phone) 
                                    VALUES ('$customer_name', '$address', '$phone')";
        $this->db->insert($insertCustomerQuery);
        $customer_id = $this->db->link->insert_id;


        // Get product price
        $productQuery = "SELECT price FROM products WHERE products_id = '$products_id'";
        $productResult = $this->db->select($productQuery);

        if ($productResult && $productResult->num_rows > 0) {
            $productRow = $productResult->fetch_assoc();
            $price = $productRow['price'];
            $total_price = $quantity * $price;
        } else {
            return false;
        }

        // Insert new order
        $insertOrderQuery = "INSERT INTO orders (total_price, customer_id,  order_date, status) 
                                 VALUES ('$total_price', '$customer_id',  '$orderDate', '$status')";
        $this->db->insert($insertOrderQuery);
        $order_id = $this->db->link->insert_id;

        $insertOrderDetailQuery = "INSERT INTO order_detail (order_id,quantity, product_id) 
                                 VALUES ( '$order_id', '$quantity','$products_id')";
        $this->db->insert($insertOrderDetailQuery);

        header("Location: checkBillAdmin.php");
        return true;
    }

    public function show_bill()
    {
        $query = "SELECT orders.*, customer.*, products.*, od.quantity FROM orders 
                INNER JOIN order_detail od ON od.order_id = orders.order_id
                INNER JOIN customer ON orders.customer_id = customer.customer_id 
                INNER JOIN products ON products.products_id = od.product_id
                ORDER BY orders.order_date DESC";

        $result = $this->db->select($query);
        return $result;
    }

    public function get_bill($order_id)
    {
        $query = "SELECT orders.*, customer.*, products.*, od.quantity FROM orders 
                INNER JOIN order_detail od ON od.order_id = orders.order_id
                INNER JOIN customer ON orders.customer_id = customer.customer_id 
                INNER JOIN products ON products.products_id = od.product_id
                WHERE orders.order_id = '$order_id'";
        return $this->db->select($query);
    }

    public function update_bill($postData)
    {
        $order_id = (int)$postData['order_id'];
        $customer_id = (int)$postData['customer_id'];
        $customer_name = $this->db->link->real_escape_string($postData['editCustomerName']);
        $product_id = (int)$postData['editProductList'];
        $quantity = (int)$postData['editQuantity'];
        $phone = $this->db->link->real_escape_string($postData['editPhone']);
        $address = $this->db->link->real_escape_string($postData['editAddress']);
        $status = (int)$postData['editOrderState'];
        $order_date = $this->db->link->real_escape_string($postData['editOrderDate']);

        // Update customer details
        $updateCustomerQuery = "UPDATE customer 
                                SET customer_name = '$customer_name', 
                                    address = '$address', 
                                    phone = '$phone' 
                                WHERE customer_id = '$customer_id'";
        $this->db->update($updateCustomerQuery);

        // Update orders
        $updateOrderQuery = "UPDATE orders 
                            SET order_date = '$order_date',
                                status = '$status' 
                            WHERE order_id = '$order_id'";
        $this->db->update($updateOrderQuery);

        // Update order details
        $queryCart = "UPDATE order_detail
        SET quantity = '$quantity',
        product_id = '$product_id'
        WHERE order_id = '$order_id'";

        $result =  $this->db->update($queryCart);

        return $result;
    }

    public function delete_bill($order_id)
    {
        $order_id = (int)$order_id;
        $query = "DELETE FROM orders WHERE order_id = '$order_id'";
        $query2 = "DELETE FROM order_detail WHERE order_id = '$order_id'";
        $this->db->delete($query2);
        if (($this->db->delete($query))  === TRUE) {
            return ['success' => true];
        } else {
            return ['errors' => "Error: " . $this->db->error];
        }
    }

    public function show_products()
    {
        $query = "SELECT * FROM products";
        $result = $this->db->select($query);
        return $result;
    }
}
