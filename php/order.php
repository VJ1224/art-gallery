<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die();
}

$name = (isset($_POST['name']) ? $_POST['name']: '');
$email = (isset($_POST['email']) ? $_POST['email']: '');
$mobile = (isset($_POST['mobile']) ? $_POST['mobile']: '');
$aname = (isset($_POST['aname']) ? $_POST['aname']: '');
$artist = (isset($_POST['artist']) ? $_POST['artist']: '');

$stmt = $conn->prepare("INSERT INTO orders VALUES (?,?,?,?,?,0)");

$stmt->bind_param("ssiss", $name, $email, $mobile, $aname, $artist);
$stmt->execute();
$conn->close();
?>