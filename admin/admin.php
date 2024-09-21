<?php
include("sideBar.php");
include("class/adminclass.php");

$admin = new admin;

$totalValue = $admin->getTotalOrderValue();
$totalOrders = $admin->getTotalOrders();
$totalCustomers = $admin->getTotalCustomers();
$topProductsResult = $admin->getTopSellingProducts();

?>

<div class="background"></div>

<div class="boxInfo">
    <div class="container-info">
        <div class="Box1">
            <img src="../uploads/img/money-bag.png" alt="">
            <h2>Tổng giá trị đơn hàng</h2>
            <p>VNĐ <?php echo number_format($totalValue); ?></p>
        </div>
        <div class="Box2">
            <img src="../uploads/img/reciept.png" alt="">
            <h2>Số lượng đơn</h2>
            <p><?php echo $totalOrders; ?></p>
        </div>
        <div class="Box3">
            <img src="../uploads/img/login.png" alt="">
            <h2>Số lượng khách hàng</h2>
            <p><?php echo $totalCustomers; ?></p>
        </div>
    </div>
</div>

<div class="top-sell">
    <div class="container-sell">
        <h2>Top sản phẩm bán chạy</h2>
        <table>
            <tr>
                <th></th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Tổng giá trị</th>
            </tr>
            <?php if ($topProductsResult) {
                while ($row = $topProductsResult->fetch_assoc()) { ?>
                    <tr>
                        <th><img src="../uploads/<?= $row['images'] ?>" alt=""></th>
                        <th><?php echo $row['title']; ?></th>
                        <th><?php echo $row['total_quantity']; ?></th>
                        <th><?php echo number_format($row['total_value']); ?></th>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
</div>


</body>

</html>