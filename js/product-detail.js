const productsDetail = [
  {
    id: 1,
    images: [
      "./img/canon/200D/200D.png",
      "./img/canon/200D/200D-2.png",
      "./img/canon/200D/200D-3.png"
    ],
    type: "canon",
    title: "Canon 200D",
    price: 40000
  },
  {
    id: 2,
    images: [
      "./img/canon/1500D-kit/1500D-kit.png",
      "./img/canon/1500D-kit/1500D-kit-2.png",
      "./img/canon/1500D-kit/1500D-kit-3.png"
    ],
    type: "canon",
    title: "Canon 1500D-kit",
    price: 43000
  },
  {
    id: 3,
    images: [
      "./img/canon/3000D-kit/3000D-kit.png",
      "./img/canon/3000D-kit/3000D-kit-2.png",
      "./img/canon/3000D-kit/3000D-kit-3.png"
    ],
    type: "canon",
    title: "Canon 3000D-kit",
    price: 16000
  },
  {
    id: 4,
    images: [
      "./img/canon/G7-X-mark/G7-X-mark.png",
      "./img/canon/G7-X-mark/G7-X-mark-2.png",
      "./img/canon/G7-X-mark/G7-X-mark-3.png"
    ],
    type: "canon",
    title: "Canon G7-X-mark",
    price: 23100
  },
  {
    id: 5,
    images: [
      "./img/canon/phukien/speedlite.png"
    ],
    type: "phu kien",
    title: "Đèn speedlite",
    price: 5400
  },
  {
    id: 6,
    images: [
      "./img/canon/R7/R7.png",
      "./img/canon/R7/R7-2.png",
      "./img/canon/R7/R7-3.png"
    ],
    type: "canon",
    title: "Canon R7",
    price: 54322
  },
  {
    id: 7,
    images: [
      "./img/canon/R8/R8.png",
      "./img/canon/R8/R8-2.png",
      "./img/canon/R8/R8-3.png"
    ],
    type: "canon",
    title: "Canon R8",
    price: 54323
  },
  {
    id: 8,
    images: [
      "./img/canon/R50/R50.png",
      "./img/canon/R50/R50-2.png",
      "./img/canon/R50/R50-3.png"
    ],
    type: "canon",
    title: "Canon R50",
    price: 32554
  },
  {
    id: 9,
    images: [
      "./img/canon/R100/R100.png",
      "./img/canon/R100/R100-2.png",
      "./img/canon/R100/R100-3.png"
    ],
    type: "canon",
    title: "Canon R100",
    price: 4325220
  },
  {
    id: 10,
    images: [
      "./img/canon/SX740-HS/SX740-HS.png",
      "./img/canon/SX740-HS/SX740-HS-2.png",
      "./img/canon/SX740-HS/SX740-HS-3.png"
    ],
    type: "canon",
    title: "Canon SX740-HS",
    price: 540030
  }
];

// Function to get query parameter by name
function getQueryParam(param) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(param);
}

// Get the product ID from the URL
const productId = getQueryParam('id');

// Find the product by ID
const product_detail = productsDetail.find(p => p.id == productId);
console.log(productId);

// Display the product details
if (product_detail) {
  document.getElementsByClassName("productDetail")[0].innerHTML =
    `<div class="container">
      <div class="product-top row">
        <p>Trang chủ</p>
        <span>&#10230;</span>
        <p>Sản phẩm</p>
        <span>&#10230;</span>
        <p>Máy ảnh DSLR</p>
        <span>&#10230;</span>
        <p>${product_detail.title}</p>
      </div>

      <div class="product-content rowFlexTop">
        <div class="product-content-left rowFlexTop">
          <div class="product-content-left-big-img">
            <img src="${product_detail.images[0]}" alt="${product_detail.title}">
          </div>
          <div class="product-content-left-small-img">
            <img src="${product_detail.images[0]}" alt="${product_detail.title} Image 2">
            <img src="${product_detail.images[1]}" alt="${product_detail.title} Image 3">
            <img src="${product_detail.images[2]}" alt="${product_detail.title} Image 4">
          </div>
        </div>

        <div class="product-content-right">
          <table class="table-detail">
            <tr>
              <td>
                Tên sản phẩm
              </td>
              <td>
                <div class="product-content-right-product-name">
                  <h1 style="color: red;">${product_detail.title}</h1>
                </div>
              </td>
            </tr>
            <tr>
              <td>Giá bán</td>
              <td>
                <div class="product-content-right-product-price">
                  <p>${product_detail.price.toLocaleString()} VNĐ
                    <span style="color: black; font-size: 16px;">(Đã có VAT)</span>
                  </p>
                </div>
              </td>
            </tr>
            <tr>
              <td>Thương hiệu</td>
              <td>${product_detail.type}</td>
            </tr>
            <tr>
              <td>Bảo hành</td>
              <td>24 tháng</td>
            </tr>
            <tr>
              <td>Màu sắc</td>
              <td>
                <div class="product-content-right-product-color">
                  <div class="product-content-right-product-color-img">
                    <img src="img/canon/200D/200D.png" alt="Màu sắc sản phẩm">
                  </div>
                </div>
              </td>
            </tr>
          </table>
          <div class="quantity">
            <p style="font-weight: bold;">Số lượng:</p>
            <input type="number" min="0" value="1">
          </div>
          <div class="quatang">
            <p style="font-weight: bold;">Sản phẩm tặng kèm</p>
            <div class="quatang_content">
              <img src="img/tangkem.jpg" alt="">
              <p>Bộ vệ sinh K&F Concept 3 in 1</p>
            </div>
          </div>


          <div class="product-content-right-product-button">
            <button>
              <img src="img/carticon.png" alt="Giỏ hàng">
              <p>MUA HÀNG</p>
            </button>
          </div>

          <div class="product-content-right-product-icon">
            <div class="product-content-right-product-icon-item">
              <img src="img/hotline-icon.jpg" alt="Hotline">
              <p>
                Điện thoại: 02866 581 581 - Hotline: 0911 581 581 - 0917 581 581</p>
            </div>
            <div class="product-content-right-product-icon-item">
              <img src="img/mail-icon.png" alt="Mail">
              <p>Email: kqt@gmail.com - Website: www.kqtcamera.vn</p>
            </div>
          </div>

          <div class="product-content-right-product-QR">
            <p style="font-size: 20px; font-weight: bold;">QR code:</p>
            <img src="img/qrcode.jpg" alt="QR Code">
          </div>

          <div class="product-content-right-bottom">
            <div class="product-content-right-bottom-top">
              &#8744;
            </div>
            <div class="product-content-right-bottom-content-big">
              <div class="product-content-right-bottom-content-title row">
                <div class="product-content-right-bottom-content-title-item describe">
                  <p>Mô tả sản phẩm</p>
                </div>
                <div class="product-content-right-bottom-content-title-item info">
                  <p>Thông số kỹ thuật</p>
                </div>
                <div class="product-content-right-bottom-content-title-item">
                  <p>Hình ảnh</p>
                </div>
              </div>

              <div class="product-content-right-bottom-content">
                <div class="product-content-right-bottom-content-describe">
                  <p style="font-weight: bold;">Canon EOS 200D Mark II</p>
                  Canon EOS 200D Mark II có ngoại hình tương tự như chiếc Canon EOS 200D và những tính năng gần giống
                  với chiếc máy ảnh không gương lật Canon M50. Chiếc máy ảnh mới Canon EOS 200D Mark II được xem là
                  chiếc máy ảnh DSLR có màn hình xoay lật nhỏ gọn nhất trên thị trường hiện nay.
                </div>
                <div class="product-content-right-bottom-content-info">
                  <p style="font-weight: bold;">Chi Tiết</p>
                  - Cảm biến CMOS 24,1mpx.<br>
                  - Bộ xử lý hình ảnh DIGIC 8.<br>
                  - ISO 100 – 25600, mở rộng lên 51200.<br>
                  - Dual Pixel CMOS AF với tối đa 3975 vị trí AF trên màn hình.<br>
                  - Ống ngắm quang học, hệ AF 9 điểm.<br>
                  - Tốc độ chụp liên tiếp tối đa tới 5 hình/giây.<br>
                  - Màn hình xoay lật cảm ứng 3 inch.<br>
                  - 29 ngôn ngữ, trong đó có tiếng Việt.<br>
                  - Khung thân hợp kim nhôm và chất dẻo.<br>
                  - Kết nối wifi, bluetooth.<br>
                  - 1 khe thẻ SD, hỗ trợ SD/SDHC/SDXC.<br>
                  - Pin: LP-E17, tối đa tới 1070 tấm khi sạc đầy.<br>
                  - Kích thước: 122 x 93 x 70 mm.<br>
                  - Khối lượng: 449g.<br>
                </div>
                <div class="product-content-right-bottom-content-img">
                  <!-- <p>Hình ảnh</p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>`
    ;
} else {
  document.getElementsByClassName("productDetail").innerHTML = `<p>Product not found.</p>`;
}

function addToCart(productId) {
  // Add to cart functionality here
  alert(`Product ${productId} added to cart!`);
}