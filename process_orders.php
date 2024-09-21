<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();

session_start();

// Check if the user is logged in

if (isset($_SESSION['guest_customer_id'])) {
    $customer_id = $_SESSION['guest_customer_id'];
} else {
    die("Guest session not found. Please try again.");
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get selected payment method from form
    $payment_method = mysqli_real_escape_string($conn, $_POST['method-payment']);
    $status = ($payment_method === 'cash') ? 0 : 1;
    // Start a transaction to ensure all or nothing processing
    $conn->begin_transaction();

    try {
        // 1. Calculate the total price of the cart
        $sqlCartTotal = "SELECT SUM(p.price * c.quantity) AS total_price
                         FROM cart c
                         JOIN products p ON c.product_id = p.products_id
                         WHERE c.customer_id = $customer_id";
        $resultCartTotal = $conn->query($sqlCartTotal);

        if ($resultCartTotal && $resultCartTotal->num_rows > 0) {
            $rowCartTotal = $resultCartTotal->fetch_assoc();
            $total_price = $rowCartTotal['total_price'];
        } else {
            throw new Exception("Error calculating total price.");
        }

        // 2. Insert the order into the `orders` table
        $stmtOrder = $conn->prepare("INSERT INTO orders (customer_id, order_date, status, total_price) 
                                     VALUES (?, NOW(), '$status', ?)");
        $stmtOrder->bind_param("id", $customer_id, $total_price);
        if (!$stmtOrder->execute()) {
            throw new Exception("Error creating order: " . $stmtOrder->error);
        }

        // Get the generated order ID
        $order_id = $stmtOrder->insert_id;

        // 3. Transfer items from `cart` to `order_items`
        $sqlCartItems = "SELECT * FROM cart WHERE customer_id = $customer_id";
        $resultCartItems = $conn->query($sqlCartItems);

        if ($resultCartItems && $resultCartItems->num_rows > 0) {
            // Insert each cart item into the `order_items` table
            while ($row = $resultCartItems->fetch_assoc()) {
                $stmtOrderItem = $conn->prepare("INSERT INTO order_detail (order_id, product_id, quantity)
                                                 VALUES (?, ?, ?)");
                $stmtOrderItem->bind_param("iii", $order_id, $row['product_id'], $row['quantity']);
                if (!$stmtOrderItem->execute()) {
                    throw new Exception("Error adding order item: " . $stmtOrderItem->error);
                }
            }
        } else {
            throw new Exception("No items found in cart.");
        }

        // 4. Clear the cart after the order is placed
        $sqlClearCart = "DELETE FROM cart WHERE customer_id = $customer_id";
        if (!$conn->query($sqlClearCart)) {
            throw new Exception("Error clearing cart: " . $conn->error);
        }

        // 5. Commit the transaction if everything is successful
        $conn->commit();

        header("Location: payment_success.php?order_id=$order_id");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error processing payment: " . $e->getMessage();
    }
}
