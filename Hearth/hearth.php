<?php 
$pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8",'root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (!empty($_SESSION['username']) || !empty($_SESSION['password'])) {
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
    <title>Tarzaim</title>
    <link rel="stylesheet" href="index.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<style>
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
    color: #8b0000; /* Set the color to red */
    font-size: 19px;
    cursor: pointer;
    margin: 6px 1px 0px 0px;
}


    </style>
<body>
    <?php include '../nav/nav.php'; ?>
    
            <?php
            if(!empty($_GET['product_id'])) {
            // Use prepared statement to avoid SQL injection
            $productId = isset($_GET['product_id']) ? $_GET['product_id'] : 0;
            $stmt = $pdo->prepare("SELECT * FROM product WHERE id = $productId");
           
            $stmt->execute();
            $imageName = '';
            while ($row = $stmt->fetch()) {
              $imageName = $row['name'];
                $image_path = $row['image_path'];
                $product_name = stripcslashes(htmlspecialchars($row['product_name']));
                $description = stripcslashes(htmlspecialchars($row['description']));
                $price = stripcslashes(htmlspecialchars($row['price']));
                $currency = stripcslashes(htmlspecialchars($row['currency']));
                $old_price = stripcslashes(htmlspecialchars($row['old_price']));
                $category = stripcslashes(htmlspecialchars($row['category']));
                $user = stripcslashes(htmlspecialchars($row['client']));
            }
            
            // Insert data into the "hearth" table
            $hearth = $pdo->prepare("INSERT INTO hearth (name, image_path, product_name, description, price, currency, old_price, category, client)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            // Execute the insertion query
            $hearth->execute(array("$imageName", "$image_path", "$product_name", "$description", "$price", "$currency", "$old_price", "$category", "$user"));
            header('Location: hearth.php');
          }?>

            <?php 
            // Retrieve and display data from the "hearth" table
            $hearths = $pdo->query("SELECT * FROM hearth");?>
            <div class="etsy-app-interface">
        <div class="results-container">
           <?php while ($product = $hearths->fetch()) { 
            
            ?>
                
              
                <?php $productId = $product['id']; ?>
                <?php $imageData = base64_encode($product['image_path']); ?>

                <!-- Display product information -->
                <form action="../panier/panier.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <div class="product-card">
                    <div class="heart-container">
                    <div class="heart-circle">
    <a href="delete_hearth.php?id=<?php echo $productId; ?>">
        <ion-icon class="heart-icon" name="heart"></ion-icon>
    </a>
    
         
</div>
</div>
                        <?php echo "<a href='product.php?id=$productId'>"?>
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
            <script src="../category/category.js"></script>
        </div>
    </div>
    <div style="margin:50% 0 0 0 ">
    <?php include '../footer/footer.php'; ?>
    </div>
    
</body>
</html>
