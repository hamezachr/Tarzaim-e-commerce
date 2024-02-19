<?php
session_start();
$id = $_SESSION['id_pr'];

if (empty($_SESSION['username']) || empty($_SESSION['password'])) {
    header('Location: ../../login.php'); 
    exit();
}




    
    
    
    

    
    $imageData = ''; 
    $pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8",'root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $conn = $pdo->prepare("SELECT * FROM product WHERE id = $id");
    $conn->bindParam(':id', $id, PDO::PARAM_INT);
    $conn->execute();
    
    $row = $conn->fetch();
        if(!empty($_POST['product_name'] )) {
            $productName = $_POST['product_name'];
        }else{
            $productName = $row['product_name'];
        }
        if(!empty($_POST['description'] )) {
            $description = $_POST['description'];
        }else{
            $description = $row['descrption'];
        }    
        if(!empty($_POST['price'] )) {
            $price = $_POST['price'];
        }else{
            $price = $row['price'];
        } 
        if(!empty($_POST['old_price'] )) {
            $old_price = $_POST['old_price'];
        }else{
            $old_price = $row['old_price'];
        }   
        if(!empty($_POST['category'] )) {
            $category = $_POST['category'];
        }else{
            $category = $row['category'];
        }
        if(!empty($_POST['category'] )) {
            $category = $_POST['category'];
        }else{
            $category = $row['category'];
        }
        if (!empty($_FILES['image_path']['tmp_name'])) {
            $imageData = file_get_contents($_FILES['image_path']['tmp_name']);
        } else {
            // Use existing image data if no new image is uploaded
            $imageData = $row['image_path'];
        }
    
        // Update the product in the database
        $updateQuery = "UPDATE product SET product_name = :product_name, description = :description, price = :price, old_price = :old_price, category = :category, image_path = :image_path WHERE id = :id";
    
        $updateStatement = $pdo->prepare($updateQuery);
        $updateStatement->bindParam(':product_name', $productName, PDO::PARAM_STR);
        $updateStatement->bindParam(':description', $description, PDO::PARAM_STR);
        $updateStatement->bindParam(':price', $price, PDO::PARAM_STR);
        $updateStatement->bindParam(':old_price', $old_price, PDO::PARAM_STR);
        $updateStatement->bindParam(':category', $category, PDO::PARAM_STR);
        $updateStatement->bindParam(':image_path', $imageData, PDO::PARAM_LOB);
        $updateStatement->bindParam(':id', $id, PDO::PARAM_INT);
    
        $updateStatement->execute();
    
        // Redirect to the product page or any other page after successful update
       
        



   

?>
