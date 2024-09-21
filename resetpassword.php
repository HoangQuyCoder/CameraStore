<?php
include("navbar.php");
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'camerastore_db';
$dbconfig = mysqli_connect($host, $username, $password, $database) or die("An Error occured when connecting to the database");
session_start();

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key = mysqli_real_escape_string($dbconfig, $_POST['key']);
    $new_password = mysqli_real_escape_string($dbconfig, $_POST['new_password']);

    // Kiểm tra mã khôi phục
    $result = mysqli_query($dbconfig, "SELECT email FROM forget_password WHERE temp_key='$key'");

    if (mysqli_num_rows($result) > 0) {
        // Cập nhật mật khẩu
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];

        // Không mã hóa mật khẩu
        mysqli_query($dbconfig, "UPDATE users SET password='$new_password' WHERE email='$email'");
        mysqli_query($dbconfig, "DELETE FROM forget_password WHERE temp_key='$key'"); // Xóa mã khôi phục sau khi sử dụng

        $message = "Your password has been reset successfully!";
    } else {
        $message = "Invalid reset key!";
    }
}
?>

<div class="login account-css">
    <div class="container-login" id="container-login">
        <div class="formAccount-container sign-in-container">
            <div class="picture-side">
                <img src="img/banner-account.jpg" alt="">
            </div>
            <div class="form-account">
                <form method="POST">
                    <h1 class="label-account1">Reset Password</h1>
                    <input type="hidden" name="key" value="<?php echo $_GET['key']; ?>">
                    <input class="account-password-in" type="password" name="new_password" placeholder="New Password" required>
                    <a href="login.php">Back to Login</a>
                    <button class="btn-submit-account button-account" type="submit">Reset Password</button>
                </form>
                <?php if ($message) {
                    echo "<p>$message</p>";
                } ?>
            </div>
        </div>
    </div>
</div>

<!-- footer  -->
<?php include("footer.php"); ?>

<script src="js/login.js" type="text/javascript"></script>
</body>

</html>