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

$aname = $_POST['aname'];
$artist = $_POST['artist'];

$sql = "UPDATE orders SET complete=1 WHERE aname='".$aname."' AND artist='".$artist."'";

$result = $conn->query($sql);
$conn->close();
?>