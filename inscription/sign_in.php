<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = stripcslashes(htmlspecialchars($_POST["username"]));
    $password = stripcslashes(htmlspecialchars($_POST["password"]));

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            header("location: ../index/index.php");
        } else {
        echo '<script type="text/javascript">';
        echo 'alert("Mot de passe erroné. Veuillez réssayer.");';
        echo 'window.location = "index.php";';
        echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Utilisateur non trouvé.");';
        echo 'window.location = "index.php";';
        echo '</script>';
    }
}

$conn->close();
?>