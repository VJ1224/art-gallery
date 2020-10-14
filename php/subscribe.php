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

$stmt = $conn->prepare("INSERT INTO subscriptions VALUES (?,?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();
$conn->close();
?>