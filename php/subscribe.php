<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = (isset($_POST['name']) ? $_POST['name']: '');
$email = (isset($_POST['email']) ? $_POST['email']: '');

$sql = "INSERT INTO subscriptions VALUES ('".$name."','".$email."')";

$conn->query($sql);
$conn->close();
?>