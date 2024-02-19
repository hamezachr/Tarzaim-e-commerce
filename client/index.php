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
  <title>Gestion des produits</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'><link rel="stylesheet" href="./style.css">

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
      <a href="product.php">
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
  <div class="text">Gestion des produits</div>
</section>

  <script  src="./script.js"></script>

</body>
</html>
