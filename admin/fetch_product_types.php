<?php
include("class/productAdminclass.php");

if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    $products = new products; // Assuming you have a Product class
    $show_productType = $products->get_product_types_by_category($category_id);
    if ($show_productType) {
        echo '<option value="#">--Chọn loại sản phẩm--</option>';
        while ($resultA = $show_productType->fetch_assoc()) {
            echo '<option value="' . $resultA['product_type_id'] . '">' . $resultA['product_type_name'] . '</option>';
        }
    } else {
        echo '<option value="#">Không có loại sản phẩm</option>';
    }
}
