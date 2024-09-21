<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();


$cart_items = $conn->query("SELECT c.product_id, c.quantity, p.title, p.price, p.discount FROM cart c JOIN products p ON c.product_id = p.products_id");

// Initialize total price
$total_price = 0;
$conn->close();

?>

<?php include("navbar.php"); ?>

<!--------------------- Delivery -------------------------->
<div class="delivery">
  <div class="container">
    <div class="delivery-top-wrap">
      <div class="delivery-top">
        <div class="delivery-top-cart delivery-top-item">
          <img src="./uploads/img/carticon.png" alt="" />
          <span>Giỏ Hàng</span>
        </div>
        <div class="delivery-top-address delivery-top-item">
          <img src="./uploads/img/location-icon.png" alt="" />
          <span>Giao hàng</span>
        </div>
        <div class="delivery-top-payment delivery-top-item">
          <img src="./uploads/img/money-icon.png" alt="" />
          <span>Thanh toán</span>
        </div>
      </div>
    </div>
  </div>

  <div class="container-delivery">
    <div class="delivery-content row">
      <div class="delivery-content-left">

        <label>Vui lòng chọn địa chỉ giao hàng:</label>
        <div class="delivery-content-left-login row">
          <img width="15px" src="./uploads/img/login-icon.png" alt="">
          <p style="margin-left: 6px;">Đăng nhập (Nếu bạn đã có tài khoản của PROCAM)</p>
        </div>

        <form action="./delivery_xuli.php" method="POST" action="">
          <div class="delivery-content-left-customer row">
            <input checked type="radio" name="customer" value="customer" />
            <p>
              <span style="font-weight: bold">Khách lẻ</span> (Nếu bạn không muốn lưu lại thông tin)
            </p>
          </div>
          <div class="delivery-content-left-signup row">
            <input type="radio" name="customer" value="signup" />
            <p>
              <span style="font-weight: bold">Đăng ký</span> (Tạo tài khoản mới với thông tin bên dưới)
            </p>
          </div>

          <div class="delivery-content-left-input-top row">
            <div class="delivery-content-left-input-top-item">
              <label for="">Họ tên: <span style="color: red">*</span></label>
              <input type="text" name="full_name" required />
            </div>
            <div class="delivery-content-left-input-top-item">
              <label for="">Điện thoại: <span style="color: red">*</span></label>
              <input type="text" name="phone" required />
              <span class="error-message" style="color: red;"></span>
            </div>
            <div class="delivery-content-left-input-top-item">
              <label for="">Tỉnh/TP: <span style="color: red">*</span></label>
              <input type="text" name="province" required />
            </div>
            <div class="delivery-content-left-input-top-item">
              <label for="">Quận/Huyện: <span style="color: red">*</span></label>
              <input type="text" name="district" required />
            </div>
          </div>
          <div class="delivery-content-left-input-bottom row">
            <label for="">Địa chỉ: <span style="color: red">*</span></label>
            <input type="text" name="address" required />
          </div>
          <div class="delivery-content-left-button row">
            <a href="cart_detail.php"><span>&#171;</span>
              <p>Quay lại giỏ hàng</p>
            </a>
            <button type="submit">
              <p style="font-weight: bold">THANH TOÁN VÀ GIAO HÀNG</p>
            </button>
          </div>
        </form>
      </div>
      <div class="delivery-content-right">
        <table>
          <tr>
            <th>Tên sản phẩm</th>
            <th>Giảm giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
          </tr>

          <?php while ($item = $cart_items->fetch_assoc()): ?>
            <?php
            $discounted_price = $item['discount'] == 1 ? $item['price'] * 0.9 : $item['price'];

            $item_total = $discounted_price * $item['quantity'];

            $total_price += $item_total;
            ?>

            <tr>
              <td><?= htmlspecialchars($item['title']) ?></td>
              <td><?= $item['discount'] == 1 ? '-10%' : '0%' ?></td>
              <td><?= $item['quantity'] ?></td>
              <td><?= number_format($item_total, 0, ',', '.') ?>đ</td>
            </tr>
          <?php endwhile; ?>

          <tr>
            <td style="font-weight: bold" colspan="3">Tổng</td>
            <td style="font-weight: bold">
              <p><?= number_format($total_price, 0, ',', '.') ?>đ</p>
            </td>
          </tr>
          <tr>
            <td style="font-weight: bold" colspan="3">Thuế VAT</td>
            <td style="font-weight: bold">
              <p>100.000đ</p>
            </td>
          </tr>
          <tr>
            <td style="font-weight: bold" colspan="3">Tổng tiền hàng</td>
            <td style="font-weight: bold">
              <p><?= number_format($total_price + 100000, 0, ',', '.') ?>đ</p>
            </td>
          </tr>
        </table>

        <!-- Free Shipping Message -->
        <?php if ($total_price < 500000): ?>
          <p style="font-size: 14px; color: red; font-weight: bold;">
            Mua thêm <span style="font-size: 16px;"><?= number_format(500000 - $total_price, 0, ',', '.') ?></span> để được miễn phí ship
          </p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<!-- footer  -->
<?php include("footer.php"); ?>

<script>
  const phoneInput = document.querySelector('input[name="phone"]');
  const errorMessageElement = document.querySelector('.error-message');
  const form = document.querySelector('form');

  phoneInput.addEventListener('input', function() {
    const phone = this.value;

    if (phone.length > 0) {
      if (phone.length !== 10) {
        errorMessageElement.textContent = 'Số điện thoại phải đủ 10 chữ số.';
      } else if (!/^0[0-9]{9}$/.test(phone)) {
        errorMessageElement.textContent = 'Số điện thoại không hợp lệ.';
      } else {
        errorMessageElement.textContent = '';
      }
    } else {
      errorMessageElement.textContent = '';
    }
  });

  form.addEventListener('submit', function(event) {
    const phone = phoneInput.value;

    if (!/^0[0-9]{9}$/.test(phone) || phone.length !== 10) {
      event.preventDefault();
      errorMessageElement.textContent = 'Vui lòng nhập số điện thoại hợp lệ.';
    }
  });
</script>