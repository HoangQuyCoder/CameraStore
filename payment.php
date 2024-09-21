<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();
?>

<?php include("navbar.php"); ?>

<!--------------------- payment -------------------------->
<div class="payment">
    <div class="container">
        <div class="payment-top-wrap">
            <div class="payment-top">
                <div class="payment-top-cart payment-top-item">
                    <img src="./uploads/img/carticon.png" alt="">
                    <span>Giỏ Hàng</span>
                </div>
                <div class="payment-top-address payment-top-item">
                    <img src="./uploads/img/location-icon.png" alt="">
                    <span>Giao hàng</span>
                </div>
                <div class="payment-top-payment payment-top-item">
                    <img src="./uploads/img/money-icon.png" alt="">
                    <span>Thanh toán</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container-payment">
        <div class="payment-content row">
            <div class="payment-content-left">
                <div class="payment-content-left-method-delivery">
                    <p style="font-weight: bold;">Phương thức giao hàng</p>
                    <div class="payment-content-left-method-delivery-item">
                        <input checked name="giaohang" type="radio" value="nhanh">
                        <label for="">Giao hàng chuyển phát nhanh</label>
                    </div>
                    <div class="payment-content-left-method-delivery-item">
                        <input name="giaohang" type="radio" value="hoatoc">
                        <label for="">Giao hàng hỏa tốc</label>
                    </div>
                </div>
                <form action="process_orders.php" method="POST">
                    <div class="payment-content-left-method-payment">
                        <p style="font-weight: bold;">Phương thức thanh toán</p>
                        <p>Mọi giao dịch đều được bảo mật và mã hoá. Thông tin thẻ tín dụng sẽ không bao giờ được lưu lại.</p>
                        <div class="payment-content-left-method-payment-item">
                            <input name="method-payment" type="radio" value="credit_card">
                            <label for="">Thanh toán bằng thẻ tín dụng(OnePay)</label>
                        </div>
                        <div class="payment-content-left-method-payment-item-img">
                            <img width="30%" src="./uploads/img/visa-mastercart.png" alt="">
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input checked name="method-payment" type="radio" value="atm_card">
                            <label for="">Thanh toán bằng thẻ ATM(OnePay)</label>
                        </div>
                        <div class="payment-content-left-method-payment-item-img">
                            <img width="70%" src="./uploads/img/logo-bank.jpg" alt="">
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input name="method-payment" type="radio" value="momo">
                            <label for="">Thanh toán MOMO</label>
                        </div>
                        <div class="payment-content-left-method-payment-item-img">
                            <img width="10%" src="./uploads/img/momo.png" alt="">
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input name="method-payment" type="radio" value="cash">
                            <label for="">Thanh toán tiền mặt</label>
                        </div>
                    </div>
                    <div class="payment-content-right-payment">
                        <button type="submit">
                            <p style="font-weight: bold;">TIẾP TỤC THANH TOÁN</p>
                        </button>
                    </div>
                </form>
            </div>
            <div class="payment-content-right">
                <div class="payment-content-right-button">
                    <input type="text" placeholder="Mã giảm giá/Quà tặng">
                    <button><img width="25px" src="./uploads/img/check.png" alt=""></button>
                </div>
                <div class="payment-content-right-button">
                    <input type="text" placeholder="Mã thành viên">
                    <button><img width="25px" src="./uploads/img/check.png" alt=""></button>
                </div>
                <div class="payment-content-right-mnv">
                    <select name="" id="">
                        <option value="">Chọn mã nhân viên thân thiết</option>
                        <option value="">A</option>
                        <option value="">B</option>
                        <option value="">C</option>
                        <option value="">D</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer  -->
<?php include("footer.php"); ?>