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

$name = (isset($_POST['name']) ? $_POST['name']: '');
$mobile = intval(isset($_POST['mobile']) ? $_POST['mobile']: '0');
$email = (isset($_POST['email']) ? $_POST['email']: '');
$city = (isset($_POST['city']) ? $_POST['city']: '');


$stmt = $conn->prepare("SELECT * FROM artist WHERE aname=?");
$stmt->bind_param("s", $name);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0) {
  echo "0";
  die();
}

$stmt = $conn->prepare("INSERT INTO artist VALUES (?,?,?,?)");

$stmt->bind_param("siss", $name, $mobile, $email, $city);
$stmt->execute();
$conn->close();
?>