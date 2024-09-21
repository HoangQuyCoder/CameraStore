<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();

// Kiểm tra nếu phiên chưa được khởi động, thì mới khởi động nó
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'];

// Fetch user information
$user_query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user_data = $user_result->fetch_assoc();

// Fetch customer information based on user_id
$customer_query = "SELECT * FROM customer WHERE user_id = ?";
$stmt = $conn->prepare($customer_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$customer_result = $stmt->get_result();
$customer_data = $customer_result->fetch_assoc();

// Fetch order details by joining customer, customer_product, and products tables
$order_query = "SELECT
                c.customer_name,
                c.address AS address,
                p.products_id,
                p.title AS product_name,
                od.quantity AS total_quantity,
                p.price AS product_price,
                od.quantity*p.price AS total_price
FROM orders o 
INNER JOIN order_detail od ON od.order_id = o.order_id
INNER JOIN customer c ON o.customer_id = c.customer_id 
INNER JOIN products  p ON p.products_id = od.product_id
WHERE c.user_id = ?
GROUP BY p.products_id, p.title, p.price, c.customer_name, c.address";

$stmt = $conn->prepare($order_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$order_result = $stmt->get_result();

// Check if the query executed successfully and returned results
if ($stmt->error) {
    echo "Error executing query: " . $stmt->error;
} else {
    // Store orders in an array for later use
    $orders = array();
    if ($order_result->num_rows > 0) {
        while ($order = $order_result->fetch_assoc()) {
            $orders[] = $order; // Store each order in an array
        }
    }
}
?>

<?php include("navbar.php"); ?>

<div class="container_user">
    <div class="spaceNavBar" style="padding-top: 100px;"></div>
    <div class="block_user1">
        <a href="logout.php" id="logout_btn" class="logout_btn">
            <p>Đăng xuất</p>
            <img src="./uploads/img/logout.png" alt="" style="width: 22px; padding-left: 3px;">
        </a>
        <img class="img_user" src="./uploads/img/user_img.png" alt="">
        <p class="user_Name"><?php echo htmlspecialchars($user_data['username']); ?></p>
    </div>
    <h1>Thông tin cá nhân</h1>
    <div class="block_user2">
        <p>Email: <span><?php echo htmlspecialchars($user_data['email']); ?></span></p>
        <div style="display:flex; align-items:center;">
            <p>Password: <span id="password" style="display: none;"><?php echo htmlspecialchars($user_data['password']); ?></span><span id="password-hidden">********</span></p>
            <button id="toggleButton">
                <img src="./uploads/img/hide.png" alt="Show" id="toggleIcon" style="width: 25px; background-color: white; margin-bottom: -5px; padding-left:6px;">
            </button>
        </div>
    </div>
    <h1>Thông tin đơn đặt hàng</h1>
    <div class="block_user3">
        <table>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price per Unit</th>
                <th>Total Price</th>
                <th>Address</th>
            </tr>
            <?php if (!empty($orders)) {
                foreach ($orders as $order) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['total_quantity']); ?></td>
                        <td><?php echo htmlspecialchars($order['product_price']); ?></td>
                        <td><?php echo htmlspecialchars($order['total_price']); ?></td>
                        <td><?php echo htmlspecialchars($order['address']); ?></td>
                    </tr>
            <?php }
            } else {
                echo "<tr><td colspan='6'>No orders found for this user.</td></tr>";
            } ?>
        </table>
    </div>
</div>
<script>
    const toggleButton = document.getElementById('toggleButton');
    const passwordElement = document.getElementById('password');
    const passwordHiddenElement = document.getElementById('password-hidden');
    const toggleIcon = document.getElementById('toggleIcon');
    let isVisible = false;
    toggleButton.addEventListener('click', function() {
        isVisible = !isVisible;
        if (isVisible) {
            passwordElement.style.display = 'inline';
            passwordHiddenElement.style.display = 'none';
            toggleIcon.src = './uploads/img/show.png';
        } else {
            passwordElement.style.display = 'none';
            passwordHiddenElement.style.display = 'inline';
            toggleIcon.src = './uploads/img/hide.png';
        }
    });
</script>
</body>

</html>