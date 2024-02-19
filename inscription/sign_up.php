<?php
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
    $password = stripcslashes(htmlspecialchars(password_hash($_POST["password"], PASSWORD_DEFAULT))); // Hashing the password
    $confirmPassword = stripcslashes(htmlspecialchars($_POST['confirmpassword']));
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $checkUsernameQuery = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($checkUsernameQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username already exists
        echo '<script type="text/javascript">';
        echo 'alert("Le nom d\'utilisateur existe déjà. Veuillez en choisir un autre.");';
        echo 'window.location = "index.php";';
        echo '</script>';
        exit();
    }
    if ($conn->query($sql) === TRUE && $_POST["password"] == $_POST['confirmpassword']) {
        echo '<script type="text/javascript">';
        echo 'alert("Votre compte Tarzaim a bien été créé");';
        echo 'window.location = "index.php";'; // Replace avec le nom de votre page
        echo '</script>';
        exit();
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Les mots de passe ne correspondent pas. Veuillez réessayer.");';
        echo 'window.location = "index.php";'; // Replace avec le nom de votre page
        echo '</script>';
        exit(); // Stop further execution
    }
}

$conn->close();
?>