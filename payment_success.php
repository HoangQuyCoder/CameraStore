<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();

session_start();

// Check if order_id is set in the URL
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    die("Invalid order ID.");
}

$order_id = intval($_GET['order_id']);

// Retrieve order details
$sqlOrder = "SELECT o.order_id, o.order_date, o.status, o.total_price, c.customer_name, c.phone, c.address, c.province, c.district
              FROM orders o
              JOIN customer c ON o.customer_id = c.customer_id
              WHERE o.order_id = ?";
$stmtOrder = $conn->prepare($sqlOrder);
$stmtOrder->bind_param("i", $order_id);
$stmtOrder->execute();
$resultOrder = $stmtOrder->get_result();

if ($resultOrder->num_rows === 0) {
    die("Order not found.");
}

$order = $resultOrder->fetch_assoc();

// Retrieve order items
$sqlOrderItems = "SELECT p.title, oi.quantity, p.price
                  FROM order_detail oi
                  JOIN products p ON oi.product_id = p.products_id
                  WHERE oi.order_id = ?";
$stmtOrderItems = $conn->prepare($sqlOrderItems);
$stmtOrderItems->bind_param("i", $order_id);
$stmtOrderItems->execute();
$resultOrderItems = $stmtOrderItems->get_result();
?>


<div class="container">
    <h1>Order Confirmation</h1>
    <p>Thank you for your order! Your order has been successfully placed.</p>

    <h2>Order Details</h2>
    <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['order_id']); ?></p>
    <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
    <p><strong>Total Price:</strong> $<?php echo number_format($order['total_price'], 2); ?></p>

    <h2>Customer Information</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($order['address']) . ', ' . htmlspecialchars($order['district']) . ', ' . htmlspecialchars($order['province']); ?></p>

    <h2>Order Items</h2>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $resultOrderItems->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="home.php">Back to Home</a>
</div>
</body>

</html>

<?php
// Close connections
$stmtOrder->close();
$stmtOrderItems->close();
?>