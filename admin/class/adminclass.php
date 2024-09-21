<?php
include "database.php";
?>

<?php
class admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    function getTotalOrderValue()
    {
        $query = "SELECT SUM(orders.total_price) as total_value FROM orders";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();
        return $row['total_value'];
    }

    function getTotalOrders()
    {
        $query = "SELECT COUNT(*) as total_orders FROM orders";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();
        return $row['total_orders'];
    }

    function getTotalCustomers()
    {
        $query = "SELECT COUNT(DISTINCT customer_id) as total_customers FROM orders";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();
        return $row['total_customers'];
    }

    function getTopSellingProducts()
    {
        $query = "SELECT p.title, p.images, SUM(od.quantity) as total_quantity, SUM(od.quantity * p.price) as total_value
                FROM order_detail od
                JOIN products p ON od.product_id = p.products_id
                JOIN orders o ON od.order_id = o.order_id
                GROUP BY p.products_id
                ORDER BY total_quantity DESC
                LIMIT 5";
        $result = $this->db->select($query);
        return $result;
    }
}
