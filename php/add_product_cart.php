<?php
include_once 'db_connect.php';
$conn = getDatabaseConnection();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// If the user is not logged in, check if a guest customer has already been created
if (!isset($_SESSION['guest_customer_id'])) {
    // Create a new guest customer
    $guestName = 'Guest' . time(); // Create a unique guest name using timestamp
    $sqlGuest = "INSERT INTO customer (customer_name) VALUES ('$guestName')";
    if ($conn->query($sqlGuest) === TRUE) {
        // Get the ID of the new guest customer
        $_SESSION['guest_customer_id'] = $conn->insert_id; // Store guest customer_id in session
        $customer_id = $_SESSION['guest_customer_id']; // Set user_id to the guest customer_id
    } else {
        die("Error creating guest customer: " . $conn->error);
    }
} else {
    // If a guest customer is already created, use the stored customer_id
    $customer_id = $_SESSION['guest_customer_id'];
}


function addToCart($customerId, $productId, $quantity, $price)
{
    global $conn;

    // Escape and validate values
    $customerId = (int)$customerId;
    $productId = $conn->real_escape_string($productId);
    $quantity = (int)$quantity;
    $price = (float)$price;
    $dayBuy = date('Y-m-d H:i:s');

    // Insert into the cart table with the customer_id
    $sql = "INSERT INTO cart (customer_id, product_id, quantity, day_buy) 
            VALUES ('$customerId', '$productId', '$quantity', '$dayBuy')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added to cart successfully";
    } else {
        echo "Error adding product to cart: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];

    // Ensure the quantity is valid
    if ($quantity > 0) {
        $customerId = $customer_id; // Use the customer ID that was determined earlier
        addToCart($customerId, $productId, $quantity, $price);

        // Redirect to the cart details page
        header("Location: ../cart_detail.php");
        exit();
    } else {
        echo '<script>alert("Quantity must be greater than zero");
             window.history.back();</script>';
        exit();
    }
}

//Displays the total quantity and price of items in the cart.
// function displayCart()
// {
//     $totalQuantity = 0;
//     $priceTotal = 0;
//     foreach ($_SESSION['cart'] as $item) {
//         $totalQuantity += $item['quantity'];
//         $priceTotal += $item['price'] * $item['quantity'];
//     }
//     echo "Total Quantity: {$totalQuantity}<br>";
//     echo "Total Price: VND {$priceTotal}<br>";
// }
