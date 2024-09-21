
function addtocart(id) {
    const selectedProduct = product.find(item => item.id === id);
    const existingItem = cart.find(item => item.id === selectedProduct.id);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        selectedProduct.quantity = 1;
        cart.push({ ...selectedProduct }); // Create a copy of the product
    }

    updateCartDisplay();
}

function delElement(id) {
    const existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        existingItem.quantity -= 1;
        if (existingItem.quantity <= 0) {
            cart = cart.filter(item => item.id !== id);
        }
    }

    updateCartDisplay();
}

function updateCartDisplay() {
    let totalQuantity = 0;
    let priceTotal = 0;

    cart.forEach(item => {
        totalQuantity += item.quantity;
        priceTotal += item.price * item.quantity; // Calculate total price
    });

    document.getElementById("count").innerHTML = totalQuantity;

    const priceElements = document.getElementsByClassName("displayPrice");
    for (let i = 0; i < priceElements.length; i++) {
        priceElements[i].innerHTML = `VND ${priceTotal}`; // Update each element
    }

    // Update individual item display counts
    cart.forEach(item => {
        document.getElementById(`displayCount-${item.id}`).innerHTML = item.quantity;
    });
}

function displayBuyBox(id) {
    const target = document.getElementsByClassName(`notiBox-${id}`);
    if (target.length > 0) {
        target[0].style.display = "block";
    }
}
