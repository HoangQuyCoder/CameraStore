<?php
include_once './php/db_connect.php';
include("./php/db-type-product.php");
include("navbar.php");

$conn = getDatabaseConnection();


// SQL query to fetch cart items for the current customer
$sql = "SELECT cart.cart_id, products.price, cart.quantity, products.title, products.images 
        FROM cart 
        JOIN products ON cart.product_id = products.products_id 
        WHERE cart.customer_id = $customer_id"; // Filter by customer_id

$cart_items = $conn->query($sql);

$total_products = 0;
$total_price = 0;

$conn->close();

?>


<!-------------------------- Cart Detail -------------------------->
<div class="cart">
  <div class="container">
    <div class="cart-top-wrap">
      <div class="cart-top">
        <div class="cart-top-cart cart-top-item">
          <img src="./uploads/img/carticon.png" alt="">
          <span>Giỏ Hàng</span>
        </div>
        <div class="cart-top-address cart-top-item">
          <img src="./uploads/img/location-icon.png" alt="">
          <span>Giao hàng</span>
        </div>
        <div class="cart-top-payment cart-top-item">
          <img src="./uploads/img/money-icon.png" alt="">
          <span>Thanh toán</span>
        </div>
      </div>
    </div>
  </div>
  <div class="container-cartdetail">
    <div class="cart-content row">
      <div class="cart-content-left">
        <table>
          <tr>
            <th>Sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Màu</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Xoá</th>
          </tr>
          <?php if ($cart_items->num_rows > 0): ?>
            <?php while ($item = $cart_items->fetch_assoc()): ?>
              <tr>
                <td><img src="./uploads/<?= $item['images'] ?>" alt=""></td>
                <td>
                  <p><?= $item['title'] ?></p>
                </td>
                <td><img src="./uploads/img/spcolor.png" alt=""></td>
                <td>
                  <input type="number" min="1" value="<?= $item['quantity'] ?>" onchange="updateQuantity(<?= $item['cart_id'] ?>, this.value)">
                </td>
                <td>
                  <p><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ</p>
                </td>
                <td>
                  <form method="POST" action="./delete_from_cart.php" style="display:inline;">
                    <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                    <button style="padding: 10px;" type="submit" class="delete-button" onclick="return confirm('Are you sure you want to remove this item?');">X</button>
                  </form>
                </td>
              </tr>
              <?php
              $total_products += $item['quantity'];
              $total_price += $item['price'] * $item['quantity'];
              ?>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="6">Không có sản phẩm nào trong giỏ hàng.</td>
            </tr>
          <?php endif; ?>
        </table>
      </div>
      <div class="cart-content-right">
        <table>
          <tr>
            <th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
          </tr>
          <tr>
            <td>TỔNG SẢN PHẨM</td>
            <td><?= $total_products ?></td>
          </tr>
          <tr>
            <td>TỔNG TIỀN HÀNG</td>
            <td>
              <p><?= number_format($total_price, 0, ',', '.') ?>đ</p>
            </td>
          </tr>
          <tr>
            <td>TẠM TÍNH</td>
            <td>
              <p style="color: red; font-weight: bold;"><?= number_format($total_price, 0, ',', '.') ?>đ</p>
            </td>
          </tr>
        </table>
        <div class="cart-content-right-text">
          <p style="font-size: 16px;">Bạn sẽ được miễn phí ship khi đơn hàng của bạn có tổng giá trị trên 500.000đ</p>
          <?php if ($total_price < 500000): ?>
            <p style="font-size: 14px; color: red; font-weight: bold;">
              Mua thêm <span style="font-size: 16px;"><?= number_format(500000 - $total_price, 0, ',', '.') ?></span> để được miễn phí ship
            </p>
          <?php endif; ?>
        </div>
        <div class="cart-content-right-button">
          <a href="category.php"><button>TIẾP TỤC MUA SẮM</button></a>
          <?php if ($total_products > 0): ?>
            <a href="delivery.php"><button>
                <p style="font-weight: bold;">THANH TOÁN</p>
              </button></a>
          <?php else: ?>
            <button style="display: none;">
            </button>
          <?php endif; ?>
        </div>
        <div class="cart-content-right-login">
          <p>TÀI KHOẢN PROCAM</p>
          <p>Hãy <a href="login.php">đăng nhập</a> tài khoản của bạn để tích điểm thành viên</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- footer  -->
<?php include("footer.php"); ?>