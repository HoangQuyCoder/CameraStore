let products = [];

document.querySelectorAll(".addToCart").forEach((button) => {
  button.addEventListener("click", () => {
    const id = button.getAttribute("data-id");
    const quantityInput = document.getElementById(`userCount-${id}`);
    let currentValue = parseInt(quantityInput.value) || 0; // Default to 0 if NaN
    quantityInput.value = ++currentValue; // Increment quantity
    console.log(quantityInput.value);

    const productPrice = parseFloat(button.getAttribute("data-price")); // Get product price from data attribute
    const totalPrice = (productPrice * currentValue).toFixed(2); // Calculate total price
    const displayPrice = document.getElementById(`displayPrice-${id}`); // Get the corresponding display price element
    const formattedPrice = Number(totalPrice).toLocaleString("vi-VN", {
      style: "currency",
      currency: "VND",
    });
    displayPrice.textContent = formattedPrice;
  });
});

document.querySelectorAll(".delToCart").forEach((button) => {
  button.addEventListener("click", () => {
    const id = button.getAttribute("data-id");
    const quantityInput = document.getElementById(`userCount-${id}`);
    let currentValue = parseInt(quantityInput.value) || 0; // Default to 0 if NaN
    if (currentValue > 0) {
      quantityInput.value = --currentValue; // Decrement quantity
      console.log(quantityInput.value);

      const productPrice = parseFloat(
        button.closest("form").querySelector('input[name="price"]').value
      ); // Get product price from hidden input
      const totalPrice = (productPrice * currentValue).toFixed(2); // Calculate total price
      const displayPrice = document.getElementById(`displayPrice-${id}`); // Get the corresponding display price element
      const formattedPrice = Number(totalPrice).toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND",
      });
      displayPrice.textContent = formattedPrice;
    }
  });
});

// Cart functionality
var cart = [];

function displayBuyBox(id) {
  const target = document.getElementsByClassName(`notiBox-${id}`);
  if (target.length > 0) {
    target[0].style.display = "block";
  }
}

function openProductDetail(id) {
  window.location.href = `product.php?id=${id}`;
}
