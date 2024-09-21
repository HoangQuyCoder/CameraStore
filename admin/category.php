<?php
include("sideBar.php");
include("class/categoryclass.php");
?>

<?php
$category = new category;
$show_category = $category->show_category();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];
    $insert_category = $category->insert_category($category_name);
}
?>

<div class="btn-group">
    <div class="AdminAddBtn">
        <button class="AddProductBtn" onclick="displayAddBox()">Thêm danh mục</button>
        <div id="addProductModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="closeAddBox()">&times;</span>
                <h2>Thêm danh mục</h2>
                <form action="" method="post">
                    <label for="title">Tên danh mục:</label>
                    <input type="text" name="category_name" placeholder="Nhập tên danh mục" required>

                    <button type="submit" id="submit">Thêm danh mục</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="admin-product" id="admin-product">
    <div class="container-sell">
        <h2>Danh mục</h2>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Thao tác</th>
            </tr>
            <?php
            if ($show_category) {
                $i = 0;
                while ($result = $show_category->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td> <?php echo $i ?></td>
                        <td> <?php echo $result['category_id'] ?></td>
                        <td><?php echo $result['category_name'] ?></td>
                        <td>
                            <a href="categoryEdit.php?category_id=<?php echo $result['category_id'] ?>"><button>Edit</button></a>
                            <a href="categoryDelete.php?category_id=<?php echo $result['category_id'] ?>"><button>Delete</button></a>
                        </td>
                    </tr>
            <?php
                }
            } ?>
        </table>
    </div>
</div>

<script src="js/admin-product.js"></script>
</body>

</html>