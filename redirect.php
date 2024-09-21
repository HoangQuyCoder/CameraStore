<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Check if the user is an admin
    if ($_SESSION['is_admin'] == 1) {
        // User is an admin, redirect to admin page
        header('Location: admin/admin.php');
    } else {
        // User is logged in but not an admin, redirect to user page
        header('Location: user_page.php'); // Change to your user page
    }
} else {
    // User is not logged in, redirect to login page
    header('Location: login.php');
}
exit;
