<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Find the product index in the cart array
    $index = array_search($productId, $_SESSION['cart']);

    // If the product is found, remove it from the cart
    if ($index !== false) {
        array_splice($_SESSION['cart'], $index, 1);
    }
}
?>
