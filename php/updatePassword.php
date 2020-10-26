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
$oldpass = hash('sha256', $user . (isset($_POST['oldpass']) ? $_POST['oldpass']: ''));
$newpass = hash('sha256', $user . (isset($_POST['newpass']) ? $_POST['newpass']: ''));

$stmt = $conn->prepare("SELECT username FROM users WHERE username=? AND password=?");

$stmt->bind_param("ss", $user, $oldpass);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows == 0) {
  echo "0";
  die();
}

$stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");

$stmt->bind_param("ss", $newpass, $user);
$stmt->execute();
$conn->close();
?>