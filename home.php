<?php
include_once './php/db_connect.php';
include("./php/db-type-product.php");

$conn = getDatabaseConnection();
$sql = "SELECT products_id, images, title, price, type FROM products";
$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $products[] = $row;
  }
}

?>

<?php include("navbar.php"); ?>

<!-- banner -->
<div id="slider">
  <div class="aspect-ratio-169">
    <img src="./uploads/img/banner1.jpg" alt="" />
    <img src="./uploads/img/banner2.jpg" alt="" />
    <img src="./uploads/img/banner3.jpg" alt="" />
    <img src="./uploads/img/banner4.jpg" alt="" />
  </div>

  <div class="dot-container">
    <div class="dot active"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
  </div>
</div>

<div class="smallIntroduce">
  <hr>
  <div class="Introduce-container">
    <div class="item">
      <img src="./uploads/img/truck.png" alt="">
      <div class="conntent">
        <h2>Miễn phí vận chuyển</h2>
        <p>Giao hàng miễn phí tất cả các đơn</p>
      </div>
    </div>
    <div class="item">
      <img src="./uploads/img/check.png" alt="">
      <div class="conntent">
        <h2>Cam kết sản phẩm chính hãng</h2>
        <p>Chính hãng, có thương hiệu</p>
      </div>
    </div>
    <div class="item">
      <img src="./uploads/img/wrench.png" alt="">
      <div class="conntent">
        <h2>Bảo hành miễn phí</h2>
        <p>Bảo hành tận nơi</p>
      </div>
    </div>
    <div class="item">
      <img src="./uploads/img/surprise.png" alt="">
      <div class="conntent">
        <h2>Khuyến mại lớn</h2>
        <p>Nhiều quà tặng hấp dẫn</p>
      </div>
    </div>
  </div>
  <hr>
</div>

<div class="little-banner">
  <div class="container-img">
    <div class="block-img1">
      <img src="./uploads/img/little-banner3.jpg" alt="">
    </div>
    <div class="block-img2">
      <div class="bb1">
        <img class="img1-block2" src="./uploads/img/little-banner2.jpg" alt="">
      </div>
      <div class="bb2">
        <img src="./uploads/img/little-banner1.jpg" alt="">
      </div>
    </div>
  </div>
</div>

<!-- Content -->
<div class="canon-item">
  <h2 class="titleCanon">Canon Camera</h2>
  <div class="content">
    <div class="product-group" id="canon-product-group">
      <?php
      foreach ($canonProducts as $item) {
        $id = $item['products_id'];
        $images = $item['images'];
        $title = htmlspecialchars($item['title'], ENT_QUOTES);
        $price = htmlspecialchars($item['price'], ENT_QUOTES);
        $formattedPrice = number_format($price, 0, ',', '.'); // Format price to VND

        echo "<div id='product' class=''>
            <a class='productLink' onclick='openProductDetail($id)'>
                <img class='productImg' src='./uploads/$images' alt=''>
            </a>
            <label class='productName' for=''>$title</label>
            <p class='productPrice'>Giá từ <strong>$formattedPrice VNĐ</strong></p>
            <button class='addCart' onclick='displayBuyBox($id)'>
                <img src='./uploads/img/carticon.png' alt='cartIcon'> 
                <p class='muahang'> Mua hàng</p>
            </button>
          </div>";
      }
      ?>

    </div>
    <button class="ctrl-btn pro-prev">
      <img src="./uploads/img/left-arrow.png" alt="" />
    </button>
    <button class="ctrl-btn pro-next">
      <img src="./uploads/img/right-arrow.png" alt="" />
    </button>
  </div>
</div>

<div class="nikon-item">
  <h2 class="titleNikon">Nikon Camera</h2>
  <div class="content">
    <div class="product-group" id="nikon-product-group">
      <?php
      foreach ($nikonProducts as $item) {
        $id = $item['products_id'];
        $images = $item['images'];
        $title = htmlspecialchars($item['title'], ENT_QUOTES);
        $price = htmlspecialchars($item['price'], ENT_QUOTES);
        $formattedPrice = number_format($price, 0, ',', '.'); // Format price to VND

        echo "<div id='product' class=''>
                            <a class='productLink' onclick='openProductDetail($id)'>
                                <img class='productImg' src='./uploads/$images' alt=''>
                            </a>
                            <label class='productName' for=''>$title</label>
                            <p class='productPrice'>Giá từ <strong>$formattedPrice VNĐ</strong></p>
                            <button class='addCart' onclick='displayBuyBox($id)'>
                                <img src='./uploads/img/carticon.png' alt='cartIcon'> 
                                <p class='muahang'> Mua hàng</p>
                            </button>
                          </div>";
      }
      ?>
    </div>
    <button class="ctrl-btn pro-prev">
      <img src="./uploads/img/left-arrow.png" alt="" />
    </button>
    <button class="ctrl-btn pro-next">
      <img src="./uploads/img/right-arrow.png" alt="" />
    </button>
  </div>
</div>

<div class="sony-item">
  <h2 class="titleSony">Sony Camera</h2>
  <div class="content">
    <div class="product-group" id="sony-product-group">
      <?php
      foreach ($sonyProducts as $item) {
        $id = $item['products_id'];
        $images = $item['images'];
        $title = htmlspecialchars($item['title'], ENT_QUOTES);
        $price = htmlspecialchars($item['price'], ENT_QUOTES);
        $formattedPrice = number_format($price, 0, ',', '.'); // Format price to VND

        echo "<div id='product' class=''>
                            <a class='productLink' onclick='openProductDetail($id)'>
                                <img class='productImg' src='./uploads/$images' alt=''>
                            </a>
                            <label class='productName' for=''>$title</label>
                            <p class='productPrice'>Giá từ <strong>$formattedPrice VNĐ</strong></p>
                            <button class='addCart' onclick='displayBuyBox($id)'>
                                <img src='./uploads/img/carticon.png' alt='cartIcon'> 
                                <p class='muahang'> Mua hàng</p>  
                            </button>
                          </div>";
      }
      ?>
    </div>
    <button class="ctrl-btn pro-prev">
      <img src="./uploads/img/left-arrow.png" alt="" />
    </button>
    <button class="ctrl-btn pro-next">
      <img src="./uploads/img/right-arrow.png" alt="" />
    </button>
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

<script src="js/product-slider.js" type="text/javascript"></script>
<script src="js/product-cart.js" type="text/javascript"></script>
<script src="js/banner.js" type="text/javascript"></script>

</body>

</html>