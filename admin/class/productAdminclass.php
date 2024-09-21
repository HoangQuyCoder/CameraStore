<?php
include "database.php";
?>

<?php
class products
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function insert_products($data, $files)
    {
        $errors = [];

        $title = $this->db->link->real_escape_string($data['productName']);
        $category_id = $this->db->link->real_escape_string($data['category']);
        $type_id = $this->db->link->real_escape_string($data['productType']);
        $price = $this->db->link->real_escape_string($data['price']);
        $quantity = $this->db->link->real_escape_string($data['quantity']);
        $description = $this->db->link->real_escape_string($data['description']);
        $discount = $this->db->link->real_escape_string($data['discount']);

        // Lấy tên loại sản phẩm dựa trên type_id
        $query_type = "SELECT product_type_name FROM product_type WHERE product_type_id = '$type_id'";
        $result_type = $this->db->select($query_type);
        if ($result_type) {
            $row = $result_type->fetch_assoc();
            $type_name = $row['product_type_name'];
        } else {
            $errors['typeError'] = "Loại sản phẩm không hợp lệ!";
            return ['errors' => $errors];
        }

        // Xử lý hình ảnh chính của sản phẩm
        $image = $files['images']['name'];
        if ($image) {
            $image_tmp = $files['images']['tmp_name'];
            $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($image_ext, $allowed_ext)) {
                $image_new_name = uniqid('', true) . '.' . $image_ext;
                $image_destination = '../uploads/' . $image_new_name;
                if (!move_uploaded_file($image_tmp, $image_destination)) {
                    $errors['imageError'] = "Không thể tải lên hình ảnh!";
                }
            } else {
                $errors['imageError'] = "File ảnh không hợp lệ!";
            }
        } else {
            $errors['imageError'] = "Vui lòng chọn một hình ảnh!";
        }

        if (!empty($errors)) {
            return ['errors' => $errors];
        }

        // Thêm sản phẩm vào bảng products với tên loại sản phẩm
        $query = "INSERT INTO products (title, category_id, type, price, quantity, description, discount, images)
                  VALUES ('$title', '$category_id', '$type_name', '$price', '$quantity', '$description', '$discount', '$image_new_name')";

        $inserted_id = $this->db->insert($query);
        if (!$inserted_id) {
            return ['errors' => ['formError' => "Thêm sản phẩm thất bại!"]];
        }

        // Xử lý ảnh mô tả sản phẩm và thêm vào bảng images_des
        foreach ($files['images_des']['name'] as $key => $image_des) {
            $image_des_tmp = $files['images_des']['tmp_name'][$key];
            $image_des_ext = strtolower(pathinfo($image_des, PATHINFO_EXTENSION));
            if (in_array($image_des_ext, $allowed_ext)) {
                $image_des_new_name = uniqid('', true) . '.' . $image_des_ext;
                $image_des_destination = '../uploads/' . $image_des_new_name;
                if (!move_uploaded_file($image_des_tmp, $image_des_destination)) {
                    $errors['imageDesError'] = "Không thể tải lên ảnh mô tả!";
                } else {
                    $query_des = "INSERT INTO images_des (products_id, images_description) VALUES ('$inserted_id', '$image_des_new_name')";
                    $this->db->insert($query_des);
                }
            } else {
                $errors['imageDesError'] = "File ảnh mô tả không hợp lệ!";
            }
        }

        if (!empty($errors)) {
            return ['errors' => $errors];
        }
    }

    public function show_category()
    {
        $query = "SELECT * FROM category ORDER BY category_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_productType($category_id)
    {
        $query = "SELECT * FROM product_type WHERE category_id = '$category_id'";

        $result = $this->db->select($query);

        return $result;
    }

    public function show_products()
    {
        $query = "SELECT * FROM products WHERE category_id != 3 ORDER BY products_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_phuKien()
    {
        $query = "SELECT * FROM products WHERE category_id = 3 ORDER BY products_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_products($products_id)
    {
        $query = "SELECT * FROM products WHERE products_id = '$products_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_types_by_category($category_id)
    {
        $query = "SELECT * FROM product_type WHERE category_id = '$category_id'";
        return $this->db->select($query);
    }

    public function get_category($category_id)
    {
        $query = "SELECT * FROM category WHERE category_id = '$category_id'";
        return $this->db->select($query);
    }

    public function get_images_des($products_id)
    {
        $query = "SELECT * FROM images_des WHERE products_id = '$products_id'";
        return $this->db->select($query);
    }

    public function update_product($data, $files)
    {
        // Kết nối đến cơ sở dữ liệu
        $conn = $this->db->link;

        // Lấy dữ liệu từ form
        $products_id = mysqli_real_escape_string($conn, $data['products_id']);
        $productName = mysqli_real_escape_string($conn, $data['productName']);
        $category = mysqli_real_escape_string($conn, $data['category']);
        $productType = mysqli_real_escape_string($conn, $data['productType']);
        $price = mysqli_real_escape_string($conn, $data['price']);
        $quantity = mysqli_real_escape_string($conn, $data['quantity']);
        $description = mysqli_real_escape_string($conn, $data['description']);
        $discount = mysqli_real_escape_string($conn, $data['discount']);

        // Kiểm tra và upload ảnh sản phẩm
        $image = $files['images']['name'];
        if ($image) {
            $image_ext = pathinfo($image, PATHINFO_EXTENSION); // Lấy phần mở rộng của file ảnh
            $encoded_image_name = md5(uniqid(rand(), true)) . '.' . $image_ext; // Tạo tên ảnh mới được mã hóa
            $target_dir = "../uploads/";
            $target_file = $target_dir . $encoded_image_name;
            move_uploaded_file($files['images']['tmp_name'], $target_file);

            // Cập nhật sản phẩm cùng với đường dẫn ảnh mới
            $query = "UPDATE products 
                  SET title = '$productName', category_id = '$category', type = '$productType', price = '$price', 
                      quantity = '$quantity', description = '$description', discount = '$discount', images = '$encoded_image_name' 
                  WHERE products_id = '$products_id'";
        } else {
            // Cập nhật sản phẩm mà không thay đổi ảnh
            $query = "UPDATE products 
                  SET title = '$productName', category_id = '$category', type = '$productType', price = '$price', 
                      quantity = '$quantity', description = '$description', discount = '$discount' 
                  WHERE products_id = '$products_id'";
        }

        $update_row = $conn->query($query);

        // Xử lý ảnh mô tả sản phẩm
        if (isset($files['images_des']) && $files['images_des']['error'][0] == 0) {
            // Xóa ảnh mô tả cũ
            $images_des = $this->get_images_des($products_id);
            if ($images_des) {
                while ($result_images_des = $images_des->fetch_assoc()) {
                    $old_image_des = $result_images_des['images_description'];
                    $old_image_path = "../uploads/" . $old_image_des;
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }
                // Xóa các bản ghi ảnh mô tả cũ khỏi cơ sở dữ liệu
                $query = "DELETE FROM images_des WHERE products_id = '$products_id'";
                $conn->query($query);
            }

            // Thêm ảnh mô tả mới
            $new_images_des = $files['images_des']['name'];
            $count = count($new_images_des);
            for ($i = 0; $i < $count; $i++) {
                $image_des_name = $new_images_des[$i];
                $image_des_tmp = $files['images_des']['tmp_name'][$i];
                $image_des_ext = pathinfo($image_des_name, PATHINFO_EXTENSION); // Lấy phần mở rộng của file ảnh mô tả
                $encoded_image_des_name = md5(uniqid(rand(), true)) . '.' . $image_des_ext; // Tạo tên ảnh mô tả mới được mã hóa
                $target_dir1 = "../uploads/";
                $target_file = $target_dir1 . $encoded_image_des_name;
                move_uploaded_file($image_des_tmp, $target_file);

                // Thêm ảnh mô tả vào bảng `images_des`
                $query = "INSERT INTO images_des (products_id, images_description) 
                      VALUES ('$products_id', '$encoded_image_des_name')";
                $conn->query($query);
            }
        }

        // Kiểm tra xem cập nhật có thành công không
        if ($update_row) {
            $msg = "<span class='success'>Sản phẩm đã được cập nhật thành công.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Sản phẩm cập nhật không thành công.</span>";
            return $msg;
        }
    }


    public function delete_product($productId)
    {
        // Sanitize the product ID
        $productId = $this->db->link->real_escape_string($productId);

        // Get the images associated with the product
        $query = "SELECT images FROM products WHERE products_id = '$productId'";
        $result = $this->db->select($query);
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $image = $product['images'];

            // Delete the main image file
            if ($image && file_exists("../uploads/" . $image)) {
                unlink("uploads/" . $image);
            }

            // Delete associated description images from the images_des table
            $queryDesImages = "SELECT images_description FROM images_des WHERE products_id = '$productId'";
            $resultDesImages = $this->db->select($queryDesImages);
            if ($resultDesImages->num_rows > 0) {
                while ($imageDes = $resultDesImages->fetch_assoc()) {
                    $imageDesPath = "../uploads/" . $imageDes['images_description'];
                    if (file_exists($imageDesPath)) {
                        unlink($imageDesPath);
                    }
                }
            }

            // Delete the images from the images_des table
            $queryDeleteDesImages = "DELETE FROM images_des WHERE products_id = '$productId'";
            $this->db->select($queryDeleteDesImages);

            // Delete the product from the products table
            $queryDeleteProduct = "DELETE FROM products WHERE products_id = '$productId'";
            header("Location: productAdmin.php");

            if ($this->db->select($queryDeleteProduct)) {
                return "Sản phẩm đã được xóa thành công.";
            } else {
                return "Đã xảy ra lỗi khi xóa sản phẩm: " . $this->db->error;
            }
        } else {
            return "Không tìm thấy sản phẩm.";
        }
    }
}
