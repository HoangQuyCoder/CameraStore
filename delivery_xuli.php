<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();

session_start();

if (isset($_SESSION['guest_customer_id'])) {
    $customer_id = $_SESSION['guest_customer_id'];
} else {
    die("Guest session not found. Please try again.");
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $full_name = mysqli_real_escape_string($conn, trim($_POST['full_name']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $province = mysqli_real_escape_string($conn, trim($_POST['province']));
    $district = mysqli_real_escape_string($conn, trim($_POST['district']));
    $address = mysqli_real_escape_string($conn, trim($_POST['address']));
    $customer_type = $_POST['customer']; // Get value from form
    $customer_type_value = null; // Default value

    // Determine customer type
    if ($customer_type === 'customer') {
        $customer_type_value = 1; // Khách lẻ
    } elseif ($customer_type === 'signup') {
        $customer_type_value = 2; // Đăng ký
    }

    try {
        // Start a transaction
        $conn->begin_transaction();

        // Update existing customer record
        $stmt = $conn->prepare("UPDATE customer SET phone = ?, customer_name = ?, address = ?, district = ?, province = ?, customer_type = ?  WHERE customer_id = ?");
        $stmt->bind_param("ssssssi", $phone, $full_name, $address, $district, $province, $customer_type_value, $customer_id);

        if (!$stmt->execute()) {
            throw new Exception("Error updating customer: " . $stmt->error);
        }

        // Commit the transaction
        $conn->commit();

        // Redirect to payment page or another page
        header("Location: payment.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if something failed
        $conn->rollback();
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
}
