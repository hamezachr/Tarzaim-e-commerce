// Get all heart icons on the page
const heartIcons = document.querySelectorAll('.heart-icon');

// Add a click event listener to each heart icon
heartIcons.forEach((heartIcon) => {
  heartIcon.addEventListener('click', () => {
    // Toggle the 'active' class on click
    heartIcon.classList.toggle('active');

    // Check if the heart icon has the 'active' class
    const isActive = heartIcon.classList.contains('active');

    // Change the icon and color based on the 'active' state
    if (isActive) {
      heartIcon.name = 'heart'; // Change the icon name to 'heart'
      heartIcon.style.color = '#8B0000'; // Change the color to red
    } else {
      heartIcon.name = 'heart-outline'; // Change the icon name to 'heart-outline'
      heartIcon.style.color = ''; // Remove the color style (back to default)
    }
  });
});

// Add a submit event listener to each "Add to Cart" form
const addToCartForms = document.querySelectorAll('.add-to-cart-form');

addToCartForms.forEach((form) => {
  form.addEventListener('submit', (event) => {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Get the product information from the form
    const productId = form.querySelector('input[name="product_id"]').value;

    // Send the product information to the server to add to the cart
    addToCart(productId);
  });
});

// Function to handle adding a product to the cart
function addToCart(productId) {
  // Send an AJAX request to your server-side PHP script
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'add_to_cart.php', true);
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

// Rest of your existing code...
