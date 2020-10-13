<?php
$csv_filename = 'subscriptions_'.date('Y-m-d').'.csv';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$csv_export = '';

$sql = "SELECT * FROM subscriptions";
$result = $conn->query($sql);
$num_fields = mysqli_num_fields($result);

$csv_export.= '"Name",';
$csv_export.= '"Email",';

$csv_export.= '
';

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $csv_export.= '"'.$row["fname"].'",';
    $csv_export.= '"'.$row["email"].'",';
    $csv_export.= '
';	
  }
}

header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
file_put_contents($csv_filename, $csv_export);
echo $csv_filename;
?>