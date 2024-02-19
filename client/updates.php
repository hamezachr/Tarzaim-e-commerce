<?php
session_start();
$id = $_SESSION['id_pr'];
// Check if the user is logged in
if (!empty($_SESSION['username']) || !empty($_SESSION['password'])) {

    // Assuming you have a database connection established
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $productName = stripcslashes(htmlspecialchars($_POST['product_name']));
        $description = stripcslashes(htmlspecialchars($_POST['description']));
        $price = stripcslashes(htmlspecialchars($_POST['price']));
        $currency = stripcslashes(htmlspecialchars($_POST['currency']));
        $oldPrice = stripcslashes(htmlspecialchars($_POST['old_price']));
        $category = stripcslashes(htmlspecialchars($_POST['category']));


        $sql = "UPDATE product SET 
                product_name = '$productName', 
                description = '$description', 
                price = '$price', 
                currency = '$currency', 
                old_price = '$oldPrice', 
                category = '$category' 
                WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Product updated successfully";
            header("location: Product.php");
        } else {
            echo "Error updating product: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>
