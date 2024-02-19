<?php 
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=users;port:3306;charset=utf-8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($_SESSION['cartTotal'])) {
    $cartTotal = $_SESSION['cartTotal'];
} else {
    // Handle the case where the cart total is not set (maybe set a default value)
    $cartTotal = 0;
}
if ($_SERVER['REQUEST_METHOD'] =='POST'){
    if(!empty($_POST['f-name']) && !empty($_POST['l-name']) && !empty($_POST['adresse']) && !empty($_POST['telephone']) && !empty($_POST['city'])&& !empty($_POST['zip'])){
        $city = stripcslashes(htmlspecialchars($_POST['city']));
        
        $adresse = stripcslashes(htmlspecialchars($_POST['adresse']));
        $fname = stripcslashes(htmlspecialchars($_POST['f-name']));
        $lname = stripcslashes(htmlspecialchars($_POST['l-name']));
        $telephone = stripcslashes(htmlspecialchars($_POST['telephone']));
        $zip = stripcslashes(htmlspecialchars($_POST['zip']));
        $date = date('Y-m-d H:i:s');
        
        $client = $pdo->prepare('INSERT INTO client(prenom,nom,adresse,ville,postal,total,telephone,date) VALUES (?,?,?,?,?,?,?,?)');

        $client->execute(array($fname, $lname, $adresse, $city, $zip, $cartTotal, $telephone, $date));
        header('location: thank.php');

    
}else{
    echo"$cartTotal";
}
}else{
    echo'fuck you';
}


?>