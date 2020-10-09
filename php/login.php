<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start();

$user = (isset($_POST['username']) ? $_POST['username']: '');
$pass = hash('sha256', (isset($_POST['password']) ? $_POST['password']: ''));

$stmt = $conn->prepare("SELECT username FROM users WHERE username=? AND password=?");

$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0) {
    echo "1";
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $user;
} else {
    echo "0";
    $_SESSION["loggedin"] = false;
}

$conn->close();
?>