<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = $_POST['cart_id'];

    $sql = "DELETE FROM cart WHERE cart_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $cart_id);

        if ($stmt->execute()) {
            header("Location: cart_detail.php");
        } else {
            echo "Error: Could not execute the delete operation.";
        }
        $stmt->close();
    } else {
        echo "Error: Could not prepare the delete operation.";
    }
}

$conn->close();
