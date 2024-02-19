<?php
session_start();

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $pdo = new PDO("mysql:host=localhost;dbname=users;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    // Use prepared statement to avoid SQL injection
    $stmt = $pdo->prepare("DELETE FROM product WHERE id = :productId");
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->execute();
    header('location: product.php');
    

}
?>
