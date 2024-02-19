// Function to handle adding a product to the cart
function addToCart(productId) {
    // Send an AJAX request to add the product to the cart
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'panier.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Handle the response, e.g., show a success message
                alert(xhr.responseText);
            } else {
                // Handle errors
                alert('Error adding to cart');
            }
        }
    };

    // Send the product ID to the server
    xhr.send(`product_id=${encodeURIComponent(productId)}`);
}
