<?php
include_once 'db_connect.php';

$conn = getDatabaseConnection();

// Initialize variables
$searchQuery = '';
$products = [];

// Check if the form was submitted
if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    // Prepare and execute the SQL statement for search
    $sql = "SELECT * FROM products WHERE title LIKE ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("SQL Error: " . $conn->error); // Output the error message
    }

    $searchTerm = "%" . $searchQuery . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch results for search
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search Results</title>
    <link rel="stylesheet" href="style/style.css" />
</head>

<body>
    <h1>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h1>
    <div class="product-list">
        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p>Price: <?php echo htmlspecialchars($product['price']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>

</body>

</html>