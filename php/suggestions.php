<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();

// Initialize an empty array for suggestions
$suggestions = [];

// Handle suggestions
if (isset($_GET['suggest'])) {
    $input = $_GET['suggest'];
    $suggestionSql = "SELECT title FROM products WHERE title LIKE ?";
    $suggestionStmt = $conn->prepare($suggestionSql);

    if ($suggestionStmt === false) {
        die("SQL Error: " . $conn->error);
    }

    $suggestionTerm = "%" . $input . "%";
    $suggestionStmt->bind_param("s", $suggestionTerm);
    $suggestionStmt->execute();
    $suggestionResult = $suggestionStmt->get_result();

    // Fetch suggestions
    while ($row = $suggestionResult->fetch_assoc()) {
        $suggestions[] = $row['title'];
    }

    // Return suggestions as JSON
    header('Content-Type: application/json');
    echo json_encode($suggestions);
    exit; // Stop further execution
}

// Close the connection
$conn->close();
