<?php
session_start();
if(!empty($_SESSION['username']) || !empty($_SESSION['password'])){
$email = $_SESSION['username'];
$emailParts = explode('@', $email);
$user = $emailParts[0];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="style.css">
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</head>
<body>
    <div class="etsy-app-interface">
        <div class="header">
            <div class="title-container">
                <h1><a href="../index/index.php">Tarzaim</a></h1>
                <a href="../category/category.php" class="category-button">
                    <ion-icon name="menu-outline"></ion-icon>
                    Category
                </a>
            </div>
            <input type="text" class="search-bar" placeholder="Que cherchez-vous">
            <a href="../inscription/index.php" class="login-link"><?php if(!empty($_SESSION['username']) || !empty($_SESSION['password']) ){
                echo $user;
            }else{echo "Se Connecter";} ?></a>
            
            <a href="../hearth/hearth.php" class="icones"><ion-icon name="heart-outline"></ion-icon></a>
            <a href="../panier/panier.php" class="icones"><ion-icon name="cart-outline"></ion-icon></ion-icon></a>
            <a href="../inscription/index.php"><?php 


                if (!empty($_SESSION['username'])) {
                // User is logged in, show the logout link or button?>
                <a href="../inscription/logout.php" class="login-link">Logout</a><?php // Replace "logout.php" with your logout file
            }
?></a>
            
            <a href="../client/index.php"><?php 


if (!empty($_SESSION['username'])) {
// User is logged in, show the logout link or button?>
<a href="../client/index.php" class="icones"><ion-icon name="storefront-outline"></ion-icon></a><?php // Replace "logout.php" with your logout file
}
?></a>
        </div>
        <div class="sep"></div>
</div>
</body>
<script src='https://unpkg.com/feather-icons'></script><script  src="./script.js"></script>
</html>