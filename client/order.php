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
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'><link rel="stylesheet" href="style.css">
  <style>
        form {
            background-color: #e4e9f7;
            padding: 20px;
            border-radius: 8px;
            margin: auto;
            width: 100%;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 15px;
            border: 1px solid #ccc;
            
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        #imgPreview {
            display: none;
            width: 100%;
            margin-bottom: 10px;
        }
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn {
            border: 2px solid #3498db;
            color: #3498db;
            background-color: #fff;
            padding: 8px 20px;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .file-input {
            position: absolute;
            font-size: 100px;
            right: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }
        .image-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .preview-img {
            width: 150px;
            height: 150px;
            margin: 10px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .image-item {
            position: relative;
            width: 30%; /* Adjust as needed */
            height: 30%; /* Adjust as needed */
            overflow: hidden;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .delete-icon {
            position: absolute;
            top: 50%;
            right: 50%;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            font-size: 30px;
            cursor: pointer;
            display: none;
        }

        .image-item:hover .delete-icon {
            display: block;
        }
        select{
          border-radius: 15px;
          font-size:medium ;
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
  <div class="text">Commande</div>
<body>
    
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #11101d;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .order-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #2c2b45;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .order-header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .order-details {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .order-item {
            margin-bottom: 10px;
        }

        .order-item span {
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
</head>
<body>
        
        <?php 
         function getProductsByname($client)
         {
             global $pdo;
             $pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8",'root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
             $client = $pdo->quote($client);
             $query = "SELECT * FROM client WHERE client = $client";
             $result = $pdo->query($query);
             
             $products = array();
             
             if ($result) {
                 while ($row = $result->fetch()) {
                     $products[] = $row;
                 }
             }
             
             return $products;
         }
         $clientProducts = getProductsByname("$user");
        
        
        
        
        foreach ($clientProducts as $product) { 
        ?>
    <div class="order-container">
        <div class="order-header">Commande Client</div>
        <ul class="order-details">
            <li class="order-item"><span>Nom Client:</span> <?php echo $product['prenom'] ." ". $product['nom']; ?></li>
            <li class="order-item"><span>ID Commande:</span> <?php echo $product['id'] ?></li>
            <li class="order-item"><span>Produit:</span> <?php echo $product['produit']?></li>
            <li class="order-item"><span>Ville:</span> <?php echo $product['ville']?></li>
            <li class="order-item"><span>Adresse:</span> <?php echo $product['adresse']?></li>
            <li class="order-item"><span>N° téléphone:</span> <?php echo $product['telephone']?></li>
            <li class="order-item"><span>Quantité:</span> <?php echo $product['quantity']?></li>
            <li class="order-item"><span>Prix Total:</span> <?php echo $product['total'] * $product['quantity'];?> MAD</li>
            
        </ul>
    </div><br><br><?php } ?>


<script>
        
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
  <script  src="./script.js"></script>

</body>
</html>
