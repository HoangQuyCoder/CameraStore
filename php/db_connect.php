<?php
function getDatabaseConnection()
{
    $servername = "localhost"; // Update with your server details
    $username = "root";
    $password = "";
    $dbname = "camerastore_db";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Return the connection object
    return $conn;
}
