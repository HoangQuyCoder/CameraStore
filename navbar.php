<?php
include_once("./php/suggestions.php");
include("./php/add_product_cart.php");

$conn = getDatabaseConnection();

$sql = "SELECT SUM(quantity) as total_quantity FROM cart WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$totalQuantity = 0;

if ($result) {
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalQuantity = $row['total_quantity'] !== null ? $row['total_quantity'] : 0;
  }
} else {
  echo "Error: " . $conn->error;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style/style.css" />
  <title>CameraStore</title>
</head>

<body>
  <!-- navbar -->
  <div id="navBar">
    <div class="container ">
      <div class="logo">
        <a href="home.php">
          <img src="./uploads/img/ProCam.png" alt="" />
        </a>
      </div>
      <div class="blockNav1 hideOnMobile">
        <div class="dropdown">
          <a href="home.php">
            <button class="subBtn">
              Trang chủ
            </button>
          </a>
        </div>
        <div class="dropdown">
          <a href="#" onclick="handleCategoryClick('products', 'category.php')"><button class="subBtn">Sản phẩm</button></a>
          <div class="dropdown-content">
            <a href="#" onclick="handleBrandClick('Canon', 'category.php')">Canon</a>
            <div class="sub-dropdown"></div>

            <a href="#" onclick="handleBrandClick('Nikon', 'category.php')">Nikon</a>
            <div class="sub-dropdown"></div>

            <a href="#" onclick="handleBrandClick('Fujifilm', 'category.php')">Fujifilm</a>
            <div class="sub-dropdown"></div>

            <a href="#" onclick="handleBrandClick('Sony', 'category.php')">Sony</a>
            <div class="sub-dropdown"></div>

            <a href="#" onclick="handleBrandClick('Panasonic', 'category.php')">Panasonic</a>
            <div class="sub-dropdown"></div>
          </div>
        </div>
        <div class="dropdown">
          <a href="#" onclick="handleCategoryClick('accessories', 'category.php')"><button class="subBtn">Phụ kiện</button></a>
          <div class="dropdown-content">

            <a href="#" onclick="handleBrandClick('ongkinh', 'category.php')">Ống Kính</a>
            <div class="sub-dropdown">

            </div>

            <a href="#" onclick="handleBrandClick('boloc', 'category.php')">Bộ Lọc (Filter)</a>
            <div class="sub-dropdown">

            </div>

            <a href="#" onclick="handleBrandClick('phukienanhsang', 'category.php')">Phụ Kiện Ánh Sáng</a>
            <div class="sub-dropdown">

            </div>

            <a href="#" onclick="handleBrandClick('giado', 'category.php')">Bộ Giá Đỡ và Chân Máy</a>
            <div class="sub-dropdown">

            </div>

            <a href="#" onclick="handleBrandClick('luutru', 'category.php')">Lưu Trữ</a>
            <div class="sub-dropdown">

            </div>

            <a href="#" onclick="handleBrandClick('khac', 'category.php')">Khác</a>
            <div class="sub-dropdown">

            </div>
          </div>
        </div>
        <div class="dropdown">
          <a href="repair.php"><button class="subBtn">Sửa chữa</button></a>
        </div>
        <div class="dropdown">
          <a href="event.php">
            <button class="subBtn">Khuyến mãi</button>
          </a>
        </div>
        <div class="dropdown">
          <a href="contact.php"><button class="subBtn">Liên hệ</button></a>
        </div>
      </div>
      <button onclick=showSidebar() class="showOnMobile hideOnNavbar ml-mobile"><img class='menuImg' src='./uploads/img/menu.png'></button>
      <div class="search_box hideOn">
        <form action="./php/search.php" method="GET">
          <div class="row-search-box">
            <input type="text" id="input-box" name="query" autocomplete="off" placeholder="Tìm kiếm" />
            <button type="submit">
              <img src="./uploads/img/SearchIcon.png" alt="Search" />
            </button>
          </div>
          <div class="result-box"></div>
        </form>
      </div>
      <div class="login-icon" class='hideOnMobile'>
        <a href="redirect.php">
          <img class='hideOnMobile' width=30px src="./uploads/img/signin-icon.png" alt="" />
        </a>
      </div>
      <div id="totalCart" class='hideOnMobile'>
        <p class='hideOnMobile' id="count"><?php echo $totalQuantity; ?></p>
        <a href="cart_detail.php">
          <img src="./uploads/img/carticon.png" alt="" />
        </a>
      </div>
    </div>
  </div>

  <div class="sideBar hideOnNavbar">
    <div class="logo">
      <a href="Home.php">
        <img src="./uploads/img/ProCam.png" alt="" />
      </a>
      <button onclick=hideSidebar() class="closeBtn showOnMobile"><img class='menuImg' src='./uploads/img/close.png'></button>
    </div>
    <div class="blockNav1 hideOnMobile">

      <div class="dropdown">
        <a href="home.php">
          <button class="subBtn">
            Trang chủ
          </button>
        </a>
      </div>
      <div class="dropdown">
        <a href="category.php">
          <button class="subBtn">Sản phẩm</button>
        </a>
      </div>
      <div class="dropdown">
        <a href="category.php">
          <button class="subBtn">Phụ kiện</button>
        </a>
      </div>
      <div class="dropdown">
        <a href="repair.php">
          <button class="subBtn">Sửa chữa</button>
        </a>
      </div>
      <div class="dropdown">
        <a href="event.php">
          <button class="subBtn">Khuyến mãi</button>
        </a>
      </div>
      <div class="dropdown">
        <a href="contact.php">
          <button class="subBtn">Liên hệ</button>
        </a>
      </div>
    </div>
  </div>
  </div>

  <script src="js/navbar.js"></script>
  <script src="js/danhmuc.js" type="text/javascript"></script>

  <script>
    const inputBox = document.getElementById("input-box");
    const resultsBox = document.querySelector(".result-box");

    inputBox.addEventListener("keyup", function() {
      const query = inputBox.value;

      if (query.length > 0) {
        fetch(`./php/suggestions.php?suggest=${query}`)
          .then(response => response.json())
          .then(data => {
            displaySuggestions(data);
          });
      } else {
        resultsBox.innerHTML = "";
      }
    });

    function displaySuggestions(suggestions) {
      if (suggestions.length > 0) {
        const content = suggestions.map(suggestion => {
          return `<li onclick="selectInput('${suggestion}')">${suggestion}</li>`;
        }).join("");
        resultsBox.innerHTML = `<ul>${content}</ul>`;
      } else {
        resultsBox.innerHTML = "";
      }
    }

    function selectInput(value) {
      inputBox.value = value;
      resultsBox.innerHTML = "";
    }

    // Close the suggestion box when clicking outside of it
    document.addEventListener("click", function(event) {
      const isClickInside = document.querySelector(".search_box").contains(event.target);
      if (!isClickInside) {
        resultsBox.innerHTML = ""; // Hide suggestions
      }
    });
  </script>

  <script>
    function handleCategoryClick(category, url) {
      if (window.location.pathname.endsWith('category.php')) {
        showCategory(category);
      } else {
        window.location.href = url;
        localStorage.setItem('categoryToShow', category);
      }
    }

    function handleBrandClick(brand, url) {
      if (window.location.pathname.endsWith('category.php')) {
        filterByBrand(brand);
      } else {
        window.location.href = url;
        localStorage.setItem('brandToFilter', brand);
      }
    }

    // Kiểm tra khi trang được tải
    window.onload = function() {
      const category = localStorage.getItem('categoryToShow');
      const brand = localStorage.getItem('brandToFilter');

      if (category) {
        showCategory(category);
        localStorage.removeItem('categoryToShow');
      }

      if (brand) {
        filterByBrand(brand);
        localStorage.removeItem('brandToFilter');
      }
    };
  </script>