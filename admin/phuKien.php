<?php
include("sideBar.php");
include("class/productAdminclass.php");
?>

<?php
$phuKien = new products;
$show_phuKien = $phuKien->show_phuKien();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $insert_phuKien = $phuKien->insert_products($_POST, $_FILES);
    if (isset($insert_phuKien['errors'])) {
        $errorMessages = $insert_phuKien['errors'];
    }
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
                        $show_category = $phuKien->show_category();
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
                <th>Mô tả sản phẩm</th>
                <th>Thao tác</th>
            </tr>
            <?php
            if ($show_phuKien) {
                $i = 0;
                while ($phukien = $show_phuKien->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td> <?php echo $i ?></td>
                        <td> <img src="../uploads/<?= $phukien['images'] ?>" alt=""></td>
                        <td> <?php echo $phukien['type'] ?></td>
                        <td> <?php echo number_format($phukien['price']) ?></td>
                        <td> <?php echo $phukien['title'] ?></td>
                        <td> <?php echo $phukien['quantity'] ?></td>
                        <td> <?php echo $phukien['discount'] ?></td>
                        <td> <?php echo $phukien['description'] ?></td>
                        <td>
                            <a href="phuKienEdit.php?products_id=<?php echo $phukien['products_id'] ?>"><button>Edit</button></a>
                            <a href="phuKienDelete.php?products_id=<?php echo $phukien['products_id'] ?>"><button>Delete</button></a>
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