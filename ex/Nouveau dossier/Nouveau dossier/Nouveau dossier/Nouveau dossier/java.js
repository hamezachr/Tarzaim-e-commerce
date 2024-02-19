function showProductInfo() {
  var productInfoContainer = document.getElementById("product-info-container");

  // Toggle the visibility of the product info container
  if (productInfoContainer.style.left === "0px") {
      productInfoContainer.style.left = "-300px";
  } else {
      productInfoContainer.style.left = "0px";
  }
}
