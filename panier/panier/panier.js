
    function updateSubtotal(input, price) {
        var quantity = input.value;
        var subtotal = quantity * price;
        input.closest('tr').querySelector('.subtotal').innerText = subtotal.toFixed(2) + ' MAD';

        // Call a function to update the total sum
        updateTotal();
    }

    function updateTotal() {
        var subtotalElements = document.querySelectorAll('.subtotal');
        var total = 0;

        subtotalElements.forEach(function (element) {
            total += parseFloat(element.innerText);
        });

        document.getElementById('subtotal').innerText = total.toFixed(2) + ' MAD';
    }


    






    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const row = this.closest('tr');
                const productId = row.getAttribute('data-product-id');

                // Send an AJAX request to delete the item from the session
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_from_cart.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Remove the row from the table
                        row.remove();
                        // Update the total
                        updateTotal();
                    }
                };
                xhr.send('product_id=' + productId);
            });
        });

        function updateTotal() {
            const subtotalElements = document.querySelectorAll('.subtotal');
            let total = 0;
            subtotalElements.forEach(element => {
                total += parseFloat(element.textContent);
            });

            // Display the total
            document.getElementById('subtotal').textContent = total.toFixed(2) + ' MAD';
        }
    });
