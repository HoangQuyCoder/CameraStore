<?php

include("process_login.php");
?>

<?php include("navbar.php"); ?>

<!-- SIGN IN-->
<div class="login account-css">
    <div class="container-login" id="container-login">
        <div class="formAccount-container sign-in-container">
            <div class="picture-side">
                <img src="uploads/img/banner-account.jpg" alt="">
            </div>
            <div class="form-account">
                <form action="process_login.php" method="POST">
                    <h1 class="label-account1">ĐĂNG NHẬP</h1>
                    <h1 class="label-account1">Chào mừng bạn đã trở lại!</h1>
                    <p class="label-account-p">Để duy trì kết nối với chúng tôi vui lòng đăng nhập bằng thông tin cá nhân của bạn</p>
                    <input class="account-username-in" type="text" name="username_or_email" placeholder="Tên đăng nhập hoặc email" required />
                    <input class="account-email-in" type="password" name="password" placeholder="Mật khẩu" required />
                    <div class="actions-account">
                        <a href="forgot_password.php">Quên mật khẩu?</a>
                        <a href="register.php">Đăng ký tài khoản</a>
                    </div>
                    <input type="hidden" name="login" value="1" />
                    <button class="button-account" type="submit">ĐĂNG NHẬP</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- footer  -->
<?php include("footer.php"); ?>

<script src="js/login.js" type="text/javascript"></script>
</body>

</html>