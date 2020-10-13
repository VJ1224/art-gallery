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

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$aname = $_POST['aname'];
$artist = $_POST['artist'];

$sql = "DELETE FROM artwork WHERE aname='".$aname."' AND artist='".$artist."'";

$result = $conn->query($sql);
$conn->close();

$dir = '../images/art/';
$filename = $aname.".jpg";
unlink($dir.$filename);
?>