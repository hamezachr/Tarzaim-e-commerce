<?php 
session_start();
if(!empty($_SESSION['username']) || !empty($_SESSION['password'])){
  $email = $_SESSION['username'];
  $emailParts = explode('@', $email);
  $user = $emailParts[0];
  }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Page d'ajout de produit</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'><link rel="stylesheet" href="./style.css">
  <style>
         body {
            background-color: #e4e9f7;
            color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }

        .product-container {
            
            margin: 0 30% 0 30%;
            background-color: #1a1a2e;
            padding: 20px 0 20px 0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
         a{
          color: white;
         }

        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .product-description {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .product-image {
            max-width: 50%;
            height: auto;
            border-radius: 8px;
        }
        .tooltip {
          color: black;
        }
      </style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="sidebar">
  <div class="logo-details">
  <i class='bx bxs-store icon'></i>
  <a href="../index/index.php" class="logo_name" style="text-decoration: none;">Tarzaim</a>
    <i class='bx bx-menu' id="btn"></i>
  </div>
  <ul class="nav-list">
    
    
    
    
    
  <li>
      <a href="add_product.php">
      <i class='bx bx-plus-circle icon'></i>
        <span class="links_name">Ajouter un produit</span>
      </a>
      <span class="tooltip">Ajouter un produit</span>
    </li>
    <li>
      <a href="order.php">
        <i class='bx bx-cart-alt'></i>
        <span class="links_name">Commande</span>
      </a>
      <span class="tooltip">Commande</span>
    </li>
    <li>
      <a href="Product.php">
        <i class='bx bx-package'></i>
        <span class="links_name">Tous les Produits</span>
      </a>
      <span class="tooltip">Tous les Produits</span>
    </li>
    
    
    <li class="profile">
      <div class="profile-details">
        <img src="pngwing.com.png" alt="profileImg">
        <div class="name_job">
          <div class="name"><?php if(!empty($_SESSION['username']) || !empty($_SESSION['password']) ){
                echo $user;
            }?></div>
          
        </div>
      </div>
      <a href="../inscription/logout.php"><i class='bx bx-log-out' id="log_out"></i></a>
    </li>
  </ul>
</div>
<section class="home-section">
  <div class="text">Tous les Produits</div>
<body>
<?php
        function getProductsByname($client)
        {
            global $pdo;
            $pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8",'root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $client = $pdo->quote($client);
            $query = "SELECT * FROM product WHERE client = $client";
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
            
            <?php $clientProducts = getProductsByname("$user"); ?>

            <?php foreach ($clientProducts as $product) { ?>
                <?php $imageData = base64_encode($product['image_path']); ?>
                <?php $productId = $product['id']; ?>
                <?php $_SESSION['id_pr'] = $productId; ?>
                
                

                <a href="update.php?id=<?php echo $productId; ?>" style="text-decoration:none;">
    <div class="product-container">
        <h2 class="product-title"><?php echo $product['product_name']?></h2>
        <p class="product-description"><?php echo $product['description']?></p>
        
         <img src="<?php echo "data:image/jpeg;base64,{$imageData}" ?>" class='product-image'>
         <p class="product-description"><?php echo $product['price']?> MAD</p>
         </a>
         <a href="delete_product.php?id=<?php echo $productId; ?>" style="text-decoration:none;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
    <i class="ion-trash-a"></i> Supprimer
</a>


    </div><br><br>
    </div>
    
    
            <?php } ?>
        </div>
    </div>
  <script  src="./script.js"></script>
  <script>
        // Function to handle file input change
        document.getElementById('uploadInput').addEventListener('change', function (event) {
            const files = event.target.files;
            const gallery = document.getElementById('imageGallery');

            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('image-item');

                    const image = document.createElement('img');
                    image.src = e.target.result;

                    const deleteIcon = document.createElement('span');
                    deleteIcon.innerHTML = '&#128465;';
                    deleteIcon.classList.add('delete-icon');
                    deleteIcon.addEventListener('click', function () {
                        gallery.removeChild(imageContainer);
                    });

                    imageContainer.appendChild(image);
                    imageContainer.appendChild(deleteIcon);
                    gallery.appendChild(imageContainer);
                };
                reader.readAsDataURL(files[i]);
            }
        });
    </script>
</body>
</html>
