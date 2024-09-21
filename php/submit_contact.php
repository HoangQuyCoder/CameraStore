<?php
include_once './php/db_connect.php';
$conn = getDatabaseConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Địa chỉ email không hợp lệ.");
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, address, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $address, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
        alert('Liên hệ của bạn đã được gửi thành công!');
        window.location.href = '../Home.php'; // Redirect to home page
        </script>";
    } else {
        echo "<script> alert('Có lỗi xảy ra: ' . $stmt->error)";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect if accessed without a POST request
    header("Location: ../contact.php");
    exit();
}
