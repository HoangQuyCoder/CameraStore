<?php
include("process_login.php");
include("navbar.php");
?>

<div class="login account-css">
    <div class="container-login" id="container-login">
        <div class="formAccount-container sign-in-container">
            <div class="picture-side">
                <img src="uploads/img/banner-account.jpg" alt="">
            </div>
            <div class="form-account">
                <form action="process_login.php" method="post">
                    <h1 class="label-account1">TẠO TÀI KHOẢN</h1>
                    <h1 class="label-account1">Chào bạn!</h1>
                    <p class="label-account-p">Hãy cho chúng tôi biết thông tin của bạn để có trãi nghiệm tốt hơn</p>
                    <input class="account-username-in" type="text" name="username" placeholder="Tên đăng nhập" required />
                    <input class="account-email-in" type="email" name="email" placeholder="Email" required />
                    <input class="account-password-in" type="password" name="password" placeholder="Mật khẩu" required />
                    <input class="account-password-in" type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" required />
                    <div class="actions-account">
                        <a href="login.php">Đăng Nhập</a>
                    </div>
                    <input type="hidden" name="register" value="1" />
                    <button class="button-account" type="submit">ĐĂNG KÝ</button>
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