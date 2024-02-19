<?php 
$pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8",'root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarzaim</title>
    <link rel="stylesheet" href="bebe.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<style>
        a{
            text-decoration: none;
        }
        .product-card .back button {
  font-family: "Poppins", sans-serif;
  margin-top: 10px;
  width: 100%;
  padding: 10px;
  background-color: #000;
  color: #fff;
  border: none;
  border-radius: 5px;
  transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
}

/* Hover effect */
.product-card .back button:hover {
  background-color: #ff3366; /* Darker color on hover */
}

/* Click effect */
.product-card .back button:active {
  transform: scale(0.95); /* Slight scale down on click */
}
.etsy-app-interface .product-card .heart-icon {
  color: #000;
            font-size: 19px;
            cursor: pointer;
            margin: 6px 1px 0px 0px;
}
.etsy-app-interface .product-card .heart-container {
  position: absolute;
  top: 19px;
  right: 19px;
  display: flex;
  align-items: center;
}

.etsy-app-interface .product-card .heart-circle {
  width: 25px;
  height: 25px;
  background-color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: 5px; /* Adjust margin to your preference */
}
    </style>
</head>
<body>
    <?php include("../nav/nav.php");?>
    <div class="etsy-app-interface">
        <div class="title">
            <h1>Bébés et Enfants</h1>
        </div>
        
        <?php
        function getProductsByCategory($category)
        {
            global $pdo;
            
            $category = $pdo->quote($category);
            $query = "SELECT * FROM product WHERE category = $category";
            $result = $pdo->query($query);
            
            $products = array();
            
            if ($result) {
                while ($row = $result->fetch()) {
                    $products[] = $row;
                }
            }
            
            return $products;
        }
        ?>
        
        <div class="results-container">
            
            <?php $bebetProducts = getProductsByCategory("Bébés_et_Enfants"); ?>

            <?php foreach ($bebetProducts as $product) { ?>
                <?php $imageData = base64_encode($product['image_path']); ?>
                <?php $productId = $product['id']; ?>

                

                <!-- Second form for adding to the cart -->
                <form action="../panier/panier.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <div class="product-card">
                    <div class="heart-container">
    <div class="heart-circle">
        <a href="../Hearth/hearth.php?product_id=<?php echo $productId; ?>">
            <ion-icon class="heart-icon" name="heart-outline"></ion-icon>
        </a>
    </div>
</div>
                        <?php echo "<a href='../product/html.php?id=$productId'>"?>
                            <?php echo "<img src='data:image/jpeg;base64,{$imageData}'>"; ?>
                            <div class="back">
                                <h3><?php echo substr($product['product_name'], 0, 25); ?>...</h3>
                                
                                <p style="color: green;"><?php echo $product['price']; ?> MAD</p>
                                <p style="color: #ccc;font-size: 10px;text-decoration-line: line-through;">
                                    <?php  if(($product['old_price'])!=0){
                                        echo  $product['old_price'] . 'MAD';
                                    }
                                    ?>
                                </p>
                                <a href="../panier/panier.php"><button type="submit" name="add_to_cart">Ajouter au panier</button></a>
                            </div>
                        </a>
                    </div>
                </form>

            <?php } ?>
        </div>
    </div>
      

<script src="bebe.js"></script>

</body>

</html>
