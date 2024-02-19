/*
I want to thank Paul Rudnitskiy for his idea.
If you need full work version you can download it here  https://github.com/BlackStar1991/CardProduct
*/



window.onload = function () {

    //// SLIDER
    var slider = document.getElementsByClassName("sliderBlock_items");
    var slides = document.getElementsByClassName("sliderBlock_items__itemPhoto");
    var next = document.getElementsByClassName("sliderBlock_controls__arrowForward")[0];
    var previous = document.getElementsByClassName("sliderBlock_controls__arrowBackward")[0];
    var items = document.getElementsByClassName("sliderBlock_positionControls")[0];
    var currentSlideItem = document.getElementsByClassName("sliderBlock_positionControls__paginatorItem");

    var currentSlide = 0;
    var slideInterval = setInterval(nextSlide, 5000);  /// Delay time of slides

    function nextSlide() {
        goToSlide(currentSlide + 1);
    }

    function previousSlide() {
        goToSlide(currentSlide - 1);
    }


    function goToSlide(n) {
        slides[currentSlide].className = 'sliderBlock_items__itemPhoto';
        items.children[currentSlide].className = 'sliderBlock_positionControls__paginatorItem';
        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].className = 'sliderBlock_items__itemPhoto sliderBlock_items__showing';
        items.children[currentSlide].className = 'sliderBlock_positionControls__paginatorItem sliderBlock_positionControls__active';
    }


    next.onclick = function () {
        nextSlide();
    };
    previous.onclick = function () {
        previousSlide();
    };


    function goToSlideAfterPushTheMiniBlock() {
        for (var i = 0; i < currentSlideItem.length; i++) {
            currentSlideItem[i].onclick = function (i) {
                var index = Array.prototype.indexOf.call(currentSlideItem, this);
                goToSlide(index);
            }
        }
    }

    goToSlideAfterPushTheMiniBlock();


/////////////////////////////////////////////////////////

///// Specification Field


    var buttonFullSpecification = document.getElementsByClassName("block_specification")[0];
    var buttonSpecification = document.getElementsByClassName("block_specification__specificationShow")[0];
    var buttonInformation = document.getElementsByClassName("block_specification__informationShow")[0];

    var blockCharacteristiic = document.querySelector(".block_descriptionCharacteristic");
    var activeCharacteristic = document.querySelector(".block_descriptionCharacteristic__active");


    buttonFullSpecification.onclick = function () {

        console.log("OK");


        buttonSpecification.classList.toggle("hide");
        buttonInformation.classList.toggle("hide");


        blockCharacteristiic.classList.toggle("block_descriptionCharacteristic__active");


    };


/////  QUANTITY ITEMS

    var up = document.getElementsByClassName('block_quantity__up')[0],
        down = document.getElementsByClassName('block_quantity__down')[0],
        input = document.getElementsByClassName('block_quantity__number')[0];

    function getValue() {
        return parseInt(input.value);
    }

    up.onclick = function (event) {
        input.value = getValue() + 1;
    };
    down.onclick = function (event) {
        if (input.value <= 1) {
            return 1;
        } else {
            input.value = getValue() - 1;
        }

    }


};







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
