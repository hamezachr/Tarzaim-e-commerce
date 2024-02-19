<?php
$pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

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
    echo 'Product added to cart successfully.';
    exit;
}

// Example: Display the cart contents
$cartContents = getCart();
$cartTotal = 0; // Initialize the total price variable

foreach ($cartContents as $productId) {
    $productData = $pdo->query("SELECT * FROM product WHERE id = $productId")->fetch();
    if ($productData !== false) {
    $cartTotal += $productData['price'];}
}
$_SESSION['cartTotal'] = $cartTotal;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
</head>
<body>
    
    <ul>
        <?php foreach ($cartContents as $productId): ?>
            <?php $table = array($productId); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
<?php
$pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="panier.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<section class="pt-5 pb-5">
  <div class="container">
    <div class="row w-100">
        <div class="col-lg-12 col-md-12 col-12">
            <h3 class="display-5 mb-2 text-center">Panier</h3><br>
            
            <table id="shoppingCart" class="table table-condensed table-responsive">
                <thead>
                    <tr>
                        <th style="width:60%">Produit</th>
                        <th style="width:12%">Prix</th>
                        <th style="width:10%">Quantité</th>
                        <th style="width:16%"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($cartContents as $productId): ?>
    <tr data-product-id="<?php echo $productId; ?>">
                            <?php  $panier = $pdo->query("SELECT * FROM product WHERE id = $productId");
                            while( $row = $panier->fetch()){ 
                                ?>
                             <?php $imageData = base64_encode($row['image_path']); ?>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-md-3 text-left">
                                    <?php echo "<img src='data:image/jpeg;base64,{$imageData}' class='img-fluid d-none d-md-block rounded mb-2 shadow '>"; ?>
                                    </div>
                                    <div class="col-md-9 text-left mt-sm-2">
                                        <h4><?php echo $row['product_name']; ?></h4>
                                        <p class="font-weight-light"><?php echo $row['category']; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="subtotal" data-th="Subtotal"><?php echo $row['price']; ?> MAD</td>

                            <td data-th="Quantity">
    <input type="number" class="form-control form-control-lg text-center" value="1" onchange="updateSubtotal(this, <?php echo $row['price']; ?>)">
</td>
<td class="actions" data-th="">
    <div class="text-right">
        
            
        
        <button class="btn btn-white border-secondary bg-white btn-md mb-2 delete-btn">
            <i><ion-icon name="trash-outline"></ion-icon></i>
        </button>
    </div>
</td>
                        </tr>
                            <?php } ?>
                        <?php endforeach; ?>
                        
                </tbody>
            </table>
            <div class="float-right text-right">
                <h4>Total:</h4>
                <h1 id="subtotal"><?php echo $cartTotal; ?> MAD</h1>
            </div>
        </div>
    </div>
    <div class="row mt-4 d-flex align-items-center">
        <div class="col-sm-6 order-md-2 text-right">
            <a href="../../checkout/checkout.php" class="btn btn-primary mb-4 btn-lg pl-5 pr-5" style="background:#ff3366">Checkout</a>
        </div>
        <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
            <a href="../../index/index.php" style="color:#ff3366;text-decoration:none;">
                <i ><ion-icon name="arrow-back-outline"></ion-icon></i> Continuer Shopping</a>
        </div>
    </div>
</div>
</section>
<script src="panier.js"></script>

</body>

</html>