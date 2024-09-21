//--------Slidebar-Cartegory-----------
const itemslidebar = document.querySelectorAll(".cartegory-left-li");
itemslidebar.forEach(function (menu, index) {
  menu.addEventListener("click", function () {
    menu.classList.toggle("block");
  });
});

// Cập nhật tên thương hiệu khi click vào id="brand"
function updateBrandName(brand) {
  // Cập nhật nội dung của phần tử với id="brand"
  const brandElement = document.getElementById("brand");
  if (brandElement) {
    brandElement.textContent = brand.charAt(0).toUpperCase() + brand.slice(1);
  }
}

function showCategory(category) {
  // Ẩn tất cả các mặt hàng
  const allItems = document.querySelectorAll(".cartegory-right-content-item");
  allItems.forEach((item) => (item.style.display = "none"));

  let itemsToShow = [];

  if (category === "products") {
    itemsToShow = ["canon", "nikon", "sony", "fujifilm", "panasonic"];
  } else if (category === "accessories") {
    itemsToShow = ["Ống kính", "giado", "phukienanhsang", "luutru", "khac"];
  }

  // Hiện các mặt hàng tương ứng
  itemsToShow.forEach((id) => {
    const items = document.querySelectorAll(`#${id}`);
    items.forEach((item) => {
      item.style.display = "block";
    });
  });
}

function filterByBrand(brand) {
  const items = document.querySelectorAll(".cartegory-right-content-item");
  items.forEach((item) => {
    if (item.id === brand.toLowerCase()) {
      item.style.display = "block";
    } else {
      item.style.display = "none";
    }
  });

  // Cập nhật tên thương hiệu
  updateBrandName(brand);
}

// Giả sử bạn có một số phần tử với id="brand" để xử lý sự kiện click
document.querySelectorAll('[id="brand"]').forEach((element) => {
  element.addEventListener("click", (event) => {
    const brand = event.target.getAttribute("data-brand"); // Lấy tên thương hiệu từ thuộc tính data-brand
    filterByBrand(brand);
  });
});
