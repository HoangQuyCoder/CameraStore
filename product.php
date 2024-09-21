<?php
include_once './php/db_connect.php';
include("./php/db-type-product.php");

$conn = getDatabaseConnection();

// Get product ID from the query string
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product_detail = null;
$related_products = [];

if ($productId > 0) {
  // Prepare and execute the query for the main product
  $stmt = $conn->prepare("SELECT  * FROM products WHERE products_id = ?");
  $stmt->bind_param("i", $productId);
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $product_detail = $result->fetch_assoc();
  }

  // Fetch related products based on the same type
  if ($product_detail) {
    $type = $product_detail['type'];
    $stmt = $conn->prepare("SELECT products_id, title, price, images FROM products WHERE type = ? AND products_id != ? LIMIT 5");
    $stmt->bind_param("si", $type, $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $related_products[] = $row;
    }
  }
}

$sql = "SELECT products_id, images, title, price, type FROM products";
$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $products[] = $row;
  }
}

$related_img = [];

$stmt = $conn->prepare("SELECT id.images_description FROM images_des id WHERE id.products_id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $related_img[] = $row;
  }
}

$conn->close();
?>

<?php include("navbar.php"); ?>


<!-- Product -->
<div class="productDetail">
  <?php if ($product_detail): ?>
    <div class="container">
      <div class="product-top row">
        <p>Trang chủ</p>
        <span>&#10230;</span>
        <p>Sản phẩm</p>
        <span>&#10230;</span>
        <p><?php echo htmlspecialchars($product_detail['title']); ?></p>
      </div>

      <div class="product-content rowFlexTop">
        <div class="product-content-left rowFlexTop">
          <div class="product-content-left-big-img">
            <img src="./uploads/<?= htmlspecialchars($product_detail['images']); ?>" alt="<?= htmlspecialchars($product_detail['title']); ?>">
          </div>
          <div class="product-content-left-small-img">
            <?php
            foreach ($related_img as $related_images): ?>
              <img src="./uploads/<?= htmlspecialchars($related_images['images_description']); ?>" alt="">
            <?php endforeach; ?>
          </div>
        </div>

        <div class="product-content-right">
          <table class="table-detail">
            <tr>
              <td>Tên sản phẩm</td>
              <td>
                <div class="product-content-right-product-name">
                  <h1 style="color: red;"><?php echo htmlspecialchars($product_detail['title']); ?></h1>
                </div>
              </td>
            </tr>
            <tr>
              <td>Giá bán</td>
              <td>
                <div class="product-content-right-product-price">
                  <p><?php echo number_format($product_detail['price'], 0, ',', '.'); ?> VNĐ
                    <span style="color: black; font-size: 16px;">(Đã có VAT)</span>
                  </p>
                </div>
              </td>
            </tr>
            <tr>
              <td>Thương hiệu</td>
              <td><?php echo htmlspecialchars($product_detail['type']); ?></td>
            </tr>
            <tr>
              <td>Bảo hành</td>
              <td>24 tháng</td>
            </tr>
            <tr>
              <td>Màu sắc</td>
              <td>
                <div class="product-content-right-product-color">
                  <div class="product-content-right-product-color-img">
                    <img src="./uploads/img/spcolor.png" alt="Màu sắc sản phẩm">
                  </div>
                </div>
              </td>
            </tr>
          </table>

          <div class="quatang">
            <p style="font-weight: bold;">Sản phẩm tặng kèm</p>
            <div class="quatang_content">
              <img src="./uploads/img/tangkem.jpg" alt="">
              <p>Bộ vệ sinh K&F Concept 3 in 1</p>
            </div>
          </div>
          <div class="product-content-right-product-button">
            <button onclick='displayBuyBox(<?php echo $productId; ?>)'>
              <img src="./uploads/img/carticon.png" alt="Giỏ hàng">
              <p>MUA HÀNG</p>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="product-content-right-bottom">
      <div class="product-content-right-bottom-top">
        &#8744
      </div>
      <div class="product-content-right-bottom-content-big">
        <div class="product-content-right-bottom-content-title row">
          <div class="product-content-right-bottom-content-title-item describe">
            <p>Mô tả sản phẩm</p>
          </div>
          <div class="product-content-right-bottom-content-title-item info">
            <p>Thông số kỹ thuật</p>
          </div>
        </div>
        <div class="product-content-right-bottom-content">
          <div class="product-content-right-bottom-content-describe">
            <p><?php echo $product_detail['title'] ?></p>
            <p><?php echo $product_detail['description'] ?></p>

          </div>
          <div class="product-content-right-bottom-content-info">
            <p>Chi Tiết</p>
            Cảm biến CMOS 24,1mpx<br>
            Bộ xử lý hình ảnh DIGIC 8<br>
            ISO 100 – 25600, mở rộng lên 51200<br>
            Dual Pixel CMOS AF với tối đa 3975 vị trí AF trên màn hình<br>
            Ống ngắm quang học, hệ AF 9 điểm<br>
            Tốc độ chụp liên tiếp tối đa tới 5 hình/giây<br>
            Màn hình xoay lật cảm ứng 3 inch<br>
            29 ngôn ngữ, trong đó có tiếng Việt<br>
            Khung thân hợp kim nhôm và chất dẻo<br>
            Kết nối wifi, bluetooth<br>
            1 khe thẻ SD, hỗ trợ SD/SDHC/SDXC<br>
            Pin: LP-E17, tối đa tới 1070 tấm khi sạc đầy<br>
            Kích thước: 122 x 93 x 70 mm<br>
            Khối lượng: 449g<br>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- product-related -->
    <div class="product-related container">
      <div class="product-related-title">
        <p>SẢN PHẨM LIÊN QUAN</p>
      </div>
      <div class="row product-content">
        <?php if (!empty($related_products)): ?>
          <?php foreach ($related_products as $related_product): ?>
            <div class="product-related-item">
              <a class='productLink' onclick="openProductDetail(<?php echo $related_product['products_id'] ?>)">
                <img src="./uploads/<?= $related_product['images']; ?>" alt="<?php echo htmlspecialchars($related_product['title']); ?>">
              </a>
              <h1><?php echo htmlspecialchars($related_product['title']); ?></h1>
              <p><?php echo number_format($related_product['price'], 0, ',', '.'); ?> VNĐ </p>
              <button class='addCart' onclick="displayBuyBox(<?php echo $related_product['products_id'] ?>)"
                style="margin-left: auto; margin-right: auto;">
                <img src='./uploads/img/carticon.png' alt='cartIcon'>
                <p class='muahang'> Mua hàng</p>
              </button>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Không có sản phẩm liên quan.</p>
        <?php endif; ?>
      </div>
    </div>

    <div id="buyBox">
      <?php foreach ($products as $product): ?>
        <form method="POST" action="./php/add_product_cart.php" header="./cart_detail.php">
          <?php $image = $product['images']; ?>
          <div class="notiBox-<?php echo $product['products_id']; ?>" id="notiBox" style="display: none;">
            <div class="backgroundNoti"></div>
            <div class="littleBox">
              <button class="exitBtn" id="exitBtn" type="button" onclick="this.parentElement.parentElement.style.display='none'">X</button>
              <div class="firstInfo">
                <div class="imgAndInfo">
                  <img src="./uploads/<?= $image; ?>" alt="" class="imgInLittleBox">
                  <div class="productInfo">
                    <h2><?php echo $product['title']; ?></h2>
                    <p>
                      <span id="priceOfProduct"></span><?php echo $formattedPrice = number_format($product['price'], 0, ',', '.'); ?>
                      <span>VND</span>
                    </p>
                  </div>
                </div>
                <div class="amountproduct">
                  <button type="button" class="addToCart" data-id="<?php echo $product['products_id']; ?>" data-price="<?php echo $product['price']; ?>">+</button>
                  <input name="quantity" id="userCount-<?php echo $product['products_id']; ?>" class="amountProduct" value="0" readonly>
                  <button type="button" class="delToCart" data-id="<?php echo $product['products_id']; ?>">-</button>
                  <input type="hidden" name="quantity-<?php echo $product['products_id']; ?>" id="inputQuantity-<?php echo $product['products_id']; ?>" value="0">
                </div>
              </div>

              <div class="eventGift">
                <h2><img class="giftIcon" src="./uploads/img/giftbox.png" alt="">Chương trình khuyến mãi</h2>
                <p class="eventDes">Tặng thẻ nhớ 64GB</p>
              </div>
              <div class="lastInfo">
                <div class="countBox">
                  <h2 class="priceTemp">Tạm tính: <strong class='displayPrice' id="displayPrice-<?php echo $product['products_id']; ?>">0</strong></h2>
                </div>
                <input type="hidden" name="productId" value="<?php echo $product['products_id']; ?>">
                <input type="hidden" name="nameproduct" value="<?php echo $product['title']; ?>">
                <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                <button type="submit" class="buyBtn">Xác nhận mua</button>
              </div>
            </div>
          </div>
        </form>
      <?php endforeach; ?>
    </div>

    <!-- footer  -->
    <?php include("footer.php"); ?>

    <script src="js/product-cart.js" type="text/javascript"></script>
    <script src="js/product.js"></script>
    </body>

    </html>