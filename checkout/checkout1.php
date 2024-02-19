<?php 
session_start();
if(isset($_GET['quantity'])) {
    $_SESSION['quantity'] = $_GET['quantity'];
    // Now you can use $quantity in your checkout page
} else {
    echo'fuck you';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="checkout.css">
    <style>
       .btns a{
        text-decoration: none;
        margin: 3px 0;
        height: 30px;
        width: 40%;
        color: #cfc9e1;
        
        text-transform: uppercase;
        border: 0;
        border-radius: .3rem;
        letter-spacing: 2px; 
        &:hover {
            animation-name: btn-hov;
            animation-duration: 550ms;
            animation-fill-mode: forwards;
        }
    }
    </style>
</head>
<body>

<div class="wrapper">

    <div class="container">
        <form action="order1.php" method="POST">
            <h1>
                <i class="fas fa-shipping-fast"></i>
                Détails de livraison
            </h1>
            <div class="name">
                <div>
                    <label for="f-name">Prenom</label>
                    <input type="text" name="f-name" required>
                </div>
                <div>
                    <label for="l-name">Nom</label>
                    <input type="text" name="l-name" required>
                </div>
            </div>
            <div class="name">
                <div>
                    <label for="f-name">Adresse</label>
                    <input type="text" name="adresse" required>
                </div>
                <div>
                    <label for="l-name">Numéro téléphone</label>
                    <input type="text" name="telephone" required>
                </div>
            </div>
            <div class="name">
                <div>
                    <label for="f-name">Ville</label>
                    <input type="text" name="city" required>
                </div>
                <div>
                    <label for="l-name">Code postal</label>
                    <input type="text" name="zip" required>
                </div>
            </div>
            
            <div class="btns">
                <button>ACHETER</button>
                
            </div>
        </form>
        <div class="btns">
        <button><a href="../panier/panier/panier.php" >RETOUR AU PANIER </a></button>
        </div>
    </div>
</div>
</body>
</html>
