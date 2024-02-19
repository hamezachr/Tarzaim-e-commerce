<?php 
session_start();
$id = $_SESSION['product_id'] ;
$price = $_SESSION['product_price'];
if (isset($_SESSION['cartTotal'])) {
    $cartTotal = $_SESSION['cartTotal'];
} else {
    // Handle the case where the cart total is not set (maybe set a default value)
    $cartTotal = 0;
}
$quantity = $_SESSION['quantity'];
if ($_SERVER['REQUEST_METHOD'] =='POST'){
    if(!empty($_POST['f-name']) && !empty($_POST['l-name']) && !empty($_POST['adresse']) && !empty($_POST['telephone']) && !empty($_POST['city'])&& !empty($_POST['zip'])){
        $city = stripcslashes(htmlspecialchars($_POST['city']));
        
        $adresse = stripcslashes(htmlspecialchars($_POST['adresse']));
        $fname = stripcslashes(htmlspecialchars($_POST['f-name']));
        $lname = stripcslashes(htmlspecialchars($_POST['l-name']));
        $telephone = stripcslashes(htmlspecialchars($_POST['telephone']));
        $zip = stripcslashes(htmlspecialchars($_POST['zip']));
        $date = date('Y-m-d H:i:s');
        $pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $result = $pdo->query("SELECT * FROM product WHERE id = $id");
        while ($row = $result->fetch()) {
            $cliente = $row["client"];
            $product = $row["product_name"];
        }
        

        $pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $client = $pdo->prepare('INSERT INTO client (prenom,nom,adresse,ville,postal,total,telephone,date,quantity,client,produit) VALUES (?,?,?,?,?,?,?,?,?,?,?)');

        $client->execute(array($fname, $lname, $adresse, $city, $zip, $price, $telephone, $date,$quantity, $cliente, $product));

        header('location: thank.php');
;

    

}

}


?>