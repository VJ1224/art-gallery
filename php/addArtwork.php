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

$aname = (isset($_POST['aname']) ? $_POST['aname']: '');
$artist = (isset($_POST['artist']) ? $_POST['artist']: '');
$price = intval(isset($_POST['price']) ? $_POST['price']: '0');
$atype = (isset($_POST['atype']) ? $_POST['atype']: '');

$stmt = $conn->prepare("SELECT * FROM artwork WHERE aname=? AND artist=?");
$stmt->bind_param("ss", $aname, $artist);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0) {
  echo "0";
  die();
}

$stmt = $conn->prepare("INSERT INTO artwork VALUES (?,?,?,?,0)");

$stmt->bind_param("ssis", $aname, $artist, $price, $atype);
$stmt->execute();
$conn->close();
?>