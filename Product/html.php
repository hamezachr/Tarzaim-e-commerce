
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier d'achat</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("../nav/nav.php"); 
    
    $pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8",'root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    if(isset($_GET["id"])) {
      
      $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    
    ?>
    <?php while($row= $stmt->fetch() ) {
       $_SESSION['product_id'] = $row['id'];
       $_SESSION['product_price'] = $row['price'];
       $imageData = base64_encode($row['image_path']);  ?>
    <div style="margin:0%">
  
    <div class="card" style="margin:0%">
      <div class="card__title">
        
      </div>
      <div class="card__body" >
        <div class="half" >
          <div class="featured_text">
            <h1 style="font-size:40px"><?php echo $row['product_name']; ?></h1><br>
            <p class="sub"><?php echo $row['category']; ?></p><br>
            <p class="price"><?php echo $row['price']; ?> MAD</p><br>
          </div>
          <div class="image">
            <?php echo "<img src='data:image/jpeg;base64,{$imageData}'>"; ?>
          </div>
        </div>
        <div class="half">
          <div class="description">
            <p><?php echo $row['description']; ?></p>
          </div>
          <span class="stock"><i class="fa fa-pen"></i> En stock</span><br>
          <form action="../checkout/checkout1.php" method="GET">
          <div class="quantity-input">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1" style="border-radius: 5px;width:30%;height:auto" required>
    </div>
          <div class="reviews">
            <ul class="stars">
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star-o"></i></li>
            </ul>
            
          </div>
        </div>
      </div>
      <div class="card__footer">
        <div class="recommend">
          <p>VENDU PAR</p>
          <h3 style="color:#ff3366"><?php echo $row['client']; ?></h3>
        </div>
        <div class="action">
        <button type="submit">ACHETER</button>




        </div>
      </div>
      </form>
    </div>
  
</div>
    <?php
    
    }
  }else{
    echo'Product ID not provided.';
  }
    ?>





</body>
</html>
