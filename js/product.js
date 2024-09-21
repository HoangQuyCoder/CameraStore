const des = document.querySelector(".describe");
const info = document.querySelector(".info");
const bigImg = document.querySelector(".product-content-left-big-img img");
const smallImg = document.querySelectorAll(
  ".product-content-left-small-img img"
);
const butTon = document.querySelector(".product-content-right-bottom-top");
const bigContent = document.querySelector(
  ".product-content-right-bottom-content-big"
);

if (bigContent) {
  bigContent.style.display = "none";
}

smallImg.forEach(function (imgItem) {
  imgItem.addEventListener("click", function () {
    bigImg.src = imgItem.src;
  });
});

if (des) {
  des.addEventListener("click", function () {
    document.querySelector(
      ".product-content-right-bottom-content-describe"
    ).style.display = "block";
    document.querySelector(
      ".product-content-right-bottom-content-info"
    ).style.display = "none";
  });
}

if (info) {
  info.addEventListener("click", function () {
    document.querySelector(
      ".product-content-right-bottom-content-describe"
    ).style.display = "none";
    document.querySelector(
      ".product-content-right-bottom-content-info"
    ).style.display = "block";
  });
}

if (butTon) {
  butTon.addEventListener("click", function () {
    bigContent.classList.toggle("activeB");

    if (bigContent.classList.contains("activeB")) {
      bigContent.style.display = "block";
    } else {
      bigContent.style.display = "none";
    }
  });
}
