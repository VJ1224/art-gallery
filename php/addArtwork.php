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
  die("Connection failed: " . $conn->connect_error);
}

$aname = (isset($_POST['aname']) ? $_POST['aname']: '');
$artist = (isset($_POST['artist']) ? $_POST['artist']: '');
$price = intval(isset($_POST['price']) ? $_POST['price']: '0');
$atype = (isset($_POST['atype']) ? $_POST['atype']: '');

$stmt = $conn->prepare("INSERT INTO artwork VALUES (?,?,?,?)");

$stmt->bind_param("ssis", $aname, $artist, $price, $atype);
$stmt->execute();
$conn->close();
?>