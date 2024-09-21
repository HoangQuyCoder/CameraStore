<?php
include("sideBar.php");
include("class/productAdminclass.php");
?>

<?php
$products = new products;
$show_products = $products->show_phuKien();

if (!isset($_GET['products_id']) || $_GET['products_id'] == NULL) {
    echo "<script>window.location = 'productAdmin.php'</script>";
    exit;
} else {
    $products_id = $_GET['products_id'];
}
?>
<?php
$get_products = $products->get_products($products_id);
if ($get_products != NULL) {
    $result = $get_products->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy phụ kiện!'); window.location = 'productAdmin.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resultMessage = $products->update_product($_POST, $_FILES);
    echo $resultMessage;
    header("Location: phuKien.php");
}
?>

<div class="btn-group">
    <div class="AdminAddBtn">
        <button class="AddProductBtn" onclick="displayAddBox()">Thêm phụ kiện</button>
        <div id="addProductModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="closeAddBox()">&times;</span>
                <h2>Thêm phụ kiện</h2>
                <form id="addProductForm" action="" method="POST" enctype="multipart/form-data">
                    <label for="productName">Nhập tên phụ kiện <span style="color: red;">*</span></label>
                    <input type="text" name="productName" id="productName" required>

                    <label for="category">Chọn danh mục <span style="color: red;">*</span></label>
                    <select name="category" id="category" required>
                        <option value="#">--Chọn danh mục--</option>
                        <?php
                        $show_category = $products->show_category();
                        if ($show_category) {
                            while ($category = $show_category->fetch_assoc()) {
                        ?>
                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <label for="productType">Chọn loại phụ kiện <span style="color: red;">*</span></label>
                    <select name="productType" id="productType" required>
                        <option value="#">--Chọn loại phụ kiện--</option>
                    </select>

                    <label for="price">Giá phụ kiện <span style="color: red;">*</span></label>
                    <input type="text" name="price" id="price" required>

                    <label for="quantity">Số lượng phụ kiện <span style="color: red;">*</span></label>
                    <input type="number" name="quantity" id="quantity" required>

                    <label for="description">Mô tả phụ kiện <span style="color: red;">*</span></label>
                    <textarea name="description" id="description" cols="30" rows="10" required></textarea>

                    <label for="discount">Mã giảm giá <span style="color: red;">*</span></label>
                    <input type="text" name="discount" id="discount" required value="0">

                    <label for="images">Ảnh phụ kiện <span style="color: red;">*</span></label>
                    <input type="file" name="images" id="images" required>
                    <span style="color: red;"><?php echo isset($errorMessages['imageError']) ? $errorMessages['imageError'] : ''; ?></span>

                    <button type="submit" id="submit">Thêm phụ kiện</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editProductModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditBox()">&times;</span>
        <h2>Chỉnh sửa phụ kiện</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="products_id" value="<?php echo htmlspecialchars($result['products_id']); ?>">

            <label for="productName">Tên phụ kiện <span style="color: red;">*</span></label>
            <input type="text" name="productName" id="productName" value="<?php echo htmlspecialchars($result['title']); ?>" required>

            <label for="category">Chọn danh mục <span style="color: red;">*</span></label>
            <select name="category" id="category" required>
                <option value="">--Chọn danh mục--</option>
                <?php
                $show_category = $products->show_category();
                if ($show_category) {
                    while ($category = $show_category->fetch_assoc()) {
                ?>
                        <option value="<?php echo $category['category_id']; ?>" <?php echo ($result['category_id'] == $category['category_id']) ? 'selected' : ''; ?>>
                            <?php echo $category['category_name']; ?>
                        </option>
                <?php
                    }
                }
                ?>
            </select>

            <label for="productType">Chọn loại phụ kiện <span style="color: red;">*</span></label>
            <select name="productType" id="productType" required>
                <option value="#">--Chọn loại phụ kiện--</option>
                <?php
                $show_product_type = $products->get_product_types_by_category($result['category_id']);
                if ($show_product_type) {
                    while ($type = $show_product_type->fetch_assoc()) {
                ?>
                        <option value="<?php echo htmlspecialchars($type['product_type_name']); ?>" <?php echo $type['product_type_name'] == $result['type'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($type['product_type_name']); ?></option>
                <?php
                    }
                }
                ?>
            </select>

            <label for="price">Giá phụ kiện <span style="color: red;">*</span></label>
            <input type="text" name="price" id="price" value="<?php echo htmlspecialchars(number_format($result['price'])); ?>" required>

            <label for="quantity">Số lượng phụ kiện <span style="color: red;">*</span></label>
            <input type="number" name="quantity" id="quantity" value="<?php echo htmlspecialchars($result['quantity']); ?>" required>

            <label for="description">Mô tả phụ kiện <span style="color: red;">*</span></label>
            <textarea name="description" id="description" cols="30" rows="10" required><?php echo htmlspecialchars($result['description']); ?></textarea>

            <label for="discount">Mã giảm giá <span style="color: red;">*</span></label>
            <input type="text" name="discount" id="discount" value="<?php echo htmlspecialchars($result['discount']); ?>" required>

            <label for="images">Ảnh phụ kiện <span style="color: red;">*</span></label>
            <img style="width: 50%; " src="../uploads/<?= $result['images'] ?> "><br>

            <input type="file" name="images" id="images">
            <span style="color: red;"><?php echo isset($errorMessages['imageError']) ? $errorMessages['imageError'] : ''; ?></span>
            <br><br>
            <button type="submit" class="submit-btn">Cập nhật phụ kiện</button>
        </form>
    </div>
</div>


<div class="admin-product" id="admin-product">
    <div class="container-sell">
        <h2>Các phụ kiện hiện tại</h2>
        <table>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên loại phụ kiện</th>
                <th>Giá</th>
                <th>Phân Loại</th>
                <th>Số lượng</th>
                <th>Mã giảm giá</th>
                <th>Mô tả phụ kiện</th>
                <th>Thao tác</th>
            </tr>
            <?php
            if ($show_products) {
                $i = 0;
                while ($product = $show_products->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td> <?php echo $i ?></td>
                        <td> <img src="../uploads/<?= $product['images'] ?>" alt=""></td>
                        <td> <?php echo $product['type'] ?></td>
                        <td> <?php echo number_format($product['price']) ?></td>
                        <td> <?php echo $product['title'] ?></td>
                        <td> <?php echo $product['quantity'] ?></td>
                        <td> <?php echo $product['discount'] ?></td>
                        <td> <?php echo $product['description'] ?></td>
                        <td>
                            <a href="phuKienEdit.php?products_id=<?php echo $product['products_id'] ?>"><button>Edit</button></a>
                            <a href="phuKienDelete.php?products_id=<?php echo $product['products_id'] ?>"><button>Delete</button></a>
                        </td>
                    </tr>
            <?php
                }
            } ?>
        </table>
    </div>
</div>

<script src="js/admin-product.js"></script>

<script>
    $(document).ready(function() {
        $('#category').on('change', function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: "fetch_product_types.php",
                    type: "POST",
                    data: {
                        category_id: categoryId
                    },
                    success: function(data) {
                        $('#productType').html(data);
                    }
                });
            } else {
                $('#productType').html('<option value="#">--Chọn loại phụ kiện--</option>');
            }
        });
    });
</script>
</body>

</html>