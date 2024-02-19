<?php 
session_start();
if(!empty($_SESSION['username']) || !empty($_SESSION['password'])){
  $email = $_SESSION['username'];
  $emailParts = explode('@', $email);
  $user = $emailParts[0];
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['id_pr'] = $id; // Store the ID in the session variable
} else {
    echo "Invalid product ID.";
    exit;
}

// The rest of your update.php code...
} else {
echo "User not logged in.";
exit;
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Page d'ajout de produit</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'><link rel="stylesheet" href="./style.css">
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
  <div class="text">Mise à Jour</div>
<body>
<form action="updates.php" method="POST">

        <label for="product_name">Nom de produit:</label><br>
        <input type="text" id="product_name" name="product_name" required><br>

        <div class="image-gallery" id="imageGallery"></div>
        

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br>

        <label for="price">Prix:</label><br>
        <input type="number" id="price" name="price" step="0.01" min="0" required><br>

        <label for="currency">Devise:</label><br>
        <input type="text" id="currency" name="currency" required><br>

        <label for="old_price">Ancien Prix (Optionnel):</label><br>
        <input type="number" id="old_price" name="old_price" step="0.01" min="0"><br>

        <label for="category">Categorie:</label><br>
        <select type="text" id="category" name="category" required>
        <option value="vetements">Vêtements</option>
        <option value="electronique">Electronique</option>
        <option value="maison_et_jardin">Maison et Jardin</option>
        <option value="bijoux">Bijoux</option>
        <option value="sante_et_beaute">Santé et Beauté</option>
        <option value="equipement_de_sport">Equipement de Sport</option>
        <option value="automobile">Automobile</option>
        <option value="bricolage_et_outils">Bricolage et Outils</option>
        <option value="bebes_et_enfants">Bébés et Enfants</option>
        <option value="art_et_artisanat">Art et artisanat</option>
        <option value="animaux_de_compagnie">Animaux de Compagnie</option>
        <option value="cuisine_et_cuisson">Cuisine et Cuisson</option>
        </select><br><br>


        <a href="updates.php"><input type="submit" value="Mise a Jour" name="submit"></a>
    </form>

</section>
<!-- partial -->
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
  <script  src="./script.js"></script>

</body>
</html>
