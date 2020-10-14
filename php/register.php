<?php
ob_start();
include('authenticate.php');
$auth = ob_get_contents();
ob_end_clean();

if ($auth == "0") {
  die();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die();
}

$user = (isset($_POST['username']) ? $_POST['username']: '');
$pass = hash('sha256', (isset($_POST['password']) ? $_POST['password']: ''));

$stmt = $conn->prepare("SELECT username FROM users WHERE username=?");

$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0) {
  echo "0";
  die();
}

$stmt = $conn->prepare("INSERT INTO users VALUES (?,?)");

$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$conn->close();
?>