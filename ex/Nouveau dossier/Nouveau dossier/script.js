document.addEventListener('DOMContentLoaded', function () {
    var button = document.querySelector('.category-button');
    var menu = document.getElementById('myMenu');

    button.addEventListener('click', function () {
        // Toggle the menu's visibility
        menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    });

    // Close the menu if the user clicks outside of it
    window.addEventListener('click', function (event) {
        if (!menu.contains(event.target) && event.target !== button) {
            menu.style.display = 'none';
        }
    });
});
