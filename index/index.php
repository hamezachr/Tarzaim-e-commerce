<?php 
$pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8",'root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
<body>
<?php include '../nav/nav.php';
$conn=  $pdo->query("SELECT * FROM product");?>
    <div class="etsy-app-interface">
       
        <div class="title">
            <h1>Découvrez des articles qui vont vous plaire. Soutenez des créateurs indépendants. Uniquement sur Tarzaim.</h1>
        </div>
        <div class="results">
            <a href="../électronic/electronique.php"><div class="profile-container">
                <div class="profile-image">
                    <img src="OIP.png" alt="Profile Image">
                </div>
                <div class="profile-name">
                    <p>Cadeaux</p>
                </div>
                
                
                </div></a>
                <a href="../Art et Artisanat/art.php"><div class="profile-container">
                    <div class="profile-image">
                        <img src="OIP1.jpg" alt="Profile Image">
                    </div>
                    <div class="profile-name">
                        <p>Loisir manuels</p>
                    </div>
                    
                    
                    </div></a>
                    <a href="../Bébés et Enfants/bebe.php"><div class="profile-container">
                        <div class="profile-image">
                            <img src="OIP2.jpg" alt="Profile Image">
                        </div>
                        <div class="profile-name">
                            <p>Pour les bébés est les enfants</p>
                        </div>
                        
                        
                        </div></a>
                
                    <a href="../Bijoux/bijoux.php"><div class="profile-container">
                        <div class="profile-image">
                            <img src="OIP3.jpg" alt="Profile Image">
                        </div>
                        <div class="profile-name">
                            <p>Bijoux</p>
                        </div>
                        
                        
                        </div></a>
                        <a href="../Équipement de Sport/sport.php"><div class="profile-container">
                            <div class="profile-image">
                                <img src="OIP (1).jpg" alt="Profile Image">
                            </div>
                            <div class="profile-name">
                                <p>Sport</p>
                            </div>
                            
                            
                            </div></a>
                        <a href="../Animaux de Compagnie/animaux.php"><div class="profile-container">
                            <div class="profile-image">
                                <img src="oip6.jpeg" alt="Profile Image">
                            </div>
                            <div class="profile-name">
                                <p>Animaux</p>
                            </div>
                            
                            
                            </div>   </a>
                             
        </div>
        














        
        

<script src="index.js"></script>

</body>
<?php include '../footer/footer.php'?>
</html>
