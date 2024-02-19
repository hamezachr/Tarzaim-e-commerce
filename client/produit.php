<?php
session_start();
if(!empty($_SESSION['username']) || !empty($_SESSION['password'])){
    $email = $_SESSION['username'];
    $emailParts = explode('@', $email);
    $user = $emailParts[0];
    }
// Database connection setup (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST["submit"]))) {
    // Get product details from form
    $image_path = $_POST['image_path'];
    $product_name = $_POST['product_name'];
    $description = stripcslashes(htmlspecialchars($_POST['description']));
    $price = stripcslashes(htmlspecialchars($_POST['price']));
    $currency = stripcslashes(htmlspecialchars($_POST['currency']));
    $old_price = stripcslashes(htmlspecialchars($_POST['old_price']));
    $category = $_POST['category'];


    if (isset($_POST['submit'])) {
        $imageName = $_FILES['image_path']['name'];
        $imageData = file_get_contents($_FILES['image_path']['tmp_name']);
        $imageData = $conn->real_escape_string($imageData);
    
        $sql = "INSERT INTO product (name, image_path, product_name, description, price, currency, old_price, category, client)
             VALUES ( '$imageName', '$imageData','$product_name', '$description', '$price', '$currency', '$old_price', '$category','$user')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "Image uploaded successfully.";
        echo '<script type="text/javascript">';
        echo 'alert("Nouveau produit ajouté avec succès.");';
        echo 'window.location = "index.php";';
        echo '</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo '<script type="text/javascript">';
        echo 'alert("Ajout de produit échoué. Veuillez réessayer");';
        echo 'window.location = "index.php";';
        echo '</script>';
    }
}
}
        


    // Prepare SQL query to insert product into the database
    

// Close connection
$conn->close();
?>