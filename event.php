<?php
include_once './php/db_connect.php';

$conn = getDatabaseConnection();

$sql = "SELECT * FROM products WHERE discount = 1";
$result = $conn->query($sql);
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>

<?php include("./navbar.php"); ?>

<div class="blockContain1">
    <div class="titleSale">
        <h1>#Khuyến Mãi Máy Ảnh</h1>
        <p>Giảm giá <strong>10%</strong></p>
    </div>
    <img src="./uploads/img/anhkhuyenmai.png" alt="">
</div>
<div id="slider"></div>

<div class="content discountProductcss" id="content">
    <div class="discountProduct product-group" id="discountProduct">
        <?php foreach ($products as $product): ?>
            <div id='product' class=''>
                <a class='productLink' onclick="openProductDetail(<?php echo $product['products_id']; ?>)">
                    <img class='productImg' src='./uploads/<?= $product['images'] ?>' alt=''>
                </a>
                <label class='productName' for=''><?php echo $product['title'] ?></label>
                <p class='productPrice'>Giá từ <strong><?php echo $formattedPrice = number_format($product['price'], 0, ',', '.'); ?> VNĐ</strong></p>
                <button class='addCart' onclick="displayBuyBox(<?php echo $product['products_id']; ?>)">
                    <img src='./uploads/img/carticon.png' alt='cartIcon'>
                    <p class='muahang'> Mua hàng</p>
                </button>
            </div>
        <?php endforeach; ?>
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

    <button class="ctrl-btn pro-prev">
        <img src="./uploads/img/left-arrow.png" alt="" />
    </button>
    <button class="ctrl-btn pro-next">
        <img src="./uploads/img/right-arrow.png" alt="" />
    </button>
</div>

<!-- footer  -->
<?php include("footer.php"); ?>

<script src="js/product-slider.js" type="text/javascript"></script>
<script src="js/discount.js"></script>
<script src="js/product-cart.js" type="text/javascript"></script>

</body>

</html>