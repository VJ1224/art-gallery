<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user = (isset($_POST['username']) ? $_POST['username']: '');
$pass = strtoupper(hash('sha256', (isset($_POST['password']) ? $_POST['password']: '')));

echo $pass;

$stmt = $conn->prepare("INSERT INTO users VALUES (?,?)");

$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$conn->close();
?>