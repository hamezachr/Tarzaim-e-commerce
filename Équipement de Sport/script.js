feather.replace()

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

// Rest of your existing code...

// Get the search bar element
const searchBar = document.querySelector('.search-bar');

// Add a listener for the 'input' event on the search bar
searchBar.addEventListener('input', () => {
  // Get the search query from the search bar
  const searchQuery = searchBar.value;

  // Make an API call to Etsy to get the search results
  const etsyAPIUrl = `https://api.etsy.com/v3/listings/active?q=${searchQuery}`;
  
  // Fetch the search results from Etsy
  fetch(etsyAPIUrl)
    .then(response => response.json())
    .then(data => {
      // Display the search results
      const resultsContainer = document.querySelector('.results-container');
      resultsContainer.innerHTML = '';

      for (const product of data.results) {
        const productCard = document.createElement('div');
        productCard.classList.add('product-card');

        const productImage = document.createElement('img');
        productImage.src = product.images[0].url_570xN;
        productCard.appendChild(productImage);

        const productTitle = document.createElement('h3');
        productTitle.textContent = product.title;
        productCard.appendChild(productTitle);

        const productDescription = document.createElement('p');
        productDescription.textContent = product.description;
        productCard.appendChild(productDescription);

        const productPrice = document.createElement('p');
        productPrice.textContent = `Price: $${product.price}`;
        productCard.appendChild(productPrice);

        const productButton = document.createElement('button');
        productButton.textContent = 'Add to cart';
        productCard.appendChild(productButton);

        // Add the product card to the results container
        resultsContainer.appendChild(productCard);
      }
    });
});
