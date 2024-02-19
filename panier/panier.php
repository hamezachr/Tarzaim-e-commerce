<?php
session_start();

// Function to add a product to the cart
function addToCart($productId) {
    // Initialize the cart if not already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add the product to the cart
    $_SESSION['cart'][] = $productId;
}

// Function to get the cart contents
function getCart() {
    return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
}

// Example: Handle the "Add to Cart" request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    addToCart($productId);
    header('location: ../panier/panier/panier.php');
    
    exit;
}

// Example: Display the cart contents
$cartContents = getCart();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier d'achat</title>
</head>
<body>
    <h2>Panier d'achat</h2>
    <ul>
        <?php foreach ($cartContents as $productId): ?>
            <li>Product ID: <?php echo $productId; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
