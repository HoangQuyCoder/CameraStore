<?php
include("sideBar.php");
include("class/productTypeclass.php");

$productType = new productType();
$show_productType = $productType->show_productType();

// Check if product_id is set
if (!isset($_GET['product_type_id']) || empty($_GET['product_type_id'])) {
    echo "<script>window.location = 'productType.php';</script>";
    exit;
} else {
    $product_type_id = $_GET['product_type_id'];
}

// Fetch product type details
$get_productType = $productType->get_productType($product_type_id);
if ($get_productType) {
    $result = $get_productType->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy loại sản phẩm!'); window.location = 'productType.php';</script>";
    exit;
}

// Handle product type deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete_productType = $productType->delete_productType($product_type_id);
    if ($delete_productType) {
        echo "<script>alert('Xóa loại sản phẩm thành công!'); window.location = 'productType.php';</script>";
    } else {
        echo "<script>alert('Xóa loại sản phẩm thất bại!');</script>";
    }
}
?>

<div class="btn-group">
    <div class="AdminAddBtn">
        <button class="AddProductBtn" onclick="displayAddBox()">Thêm loại sản phẩm</button>
        <div id="addProductModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="closeAddBox()">&times;</span>
                <h2>Thêm loại sản phẩm</h2>
                <form action="" method="post">
                    <select name="category_id" required>
                        <option value="">--Chọn danh mục--</option>
                        <?php
                        $show_category = $productType->show_category();
                        if ($show_category) {
                            while ($category = $show_category->fetch_assoc()) {
                        ?>
                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <label for="productType_name">Tên loại sản phẩm:</label>
                    <input type="text" name="productType_name" placeholder="Nhập tên loại sản phẩm" required>
                    <button type="submit" id="submit">Thêm loại sản phẩm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editProductModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditBox()">&times;</span>
        <h2>Xóa loại sản phẩm</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="product_type_name">Tên danh mục:</label>
                <?php
                $show_category = $productType->show_category();
                $category = $show_category->fetch_assoc();
                ?>
                <p> <?php echo $category['category_name']; ?>
                </p>
            </div>
            <div class="form-group">
                <label for="product_type_name">Tên loại sản phẩm:</label>
                <p><?php echo htmlspecialchars($result['product_type_name']); ?></p>
            </div>
            <button type="submit" class="submit-btn">Xóa loại sản phẩm</button>
        </form>
    </div>
</div>

<div class="admin-product" id="admin-product">
    <div class="container-sell">
        <h2>Loại sản phẩm</h2>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Tên loại sản phẩm</th>
                <th>Thao tác</th>
            </tr>
            <?php
            $show_productType = $productType->show_productType();
            if ($show_productType) {
                $i = 0;
                while ($product = $show_productType->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $product['product_type_id']; ?></td>
                        <td><?php echo $product['category_name']; ?></td>
                        <td><?php echo $product['product_type_name']; ?></td>
                        <td>
                            <a href="productTypeEdit.php?product_type_id=<?php echo $product['product_type_id']; ?>"><button>Edit</button></a>
                            <a href="productTypeDelete.php?product_type_id=<?php echo $product['product_type_id']; ?>"><button>Delete</button></a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='5'>Không có loại sản phẩm nào được tìm thấy.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<script src="js/admin-product.js"></script>
</body>

</html>