<?php
error_reporting(0);

$csv_filename = 'subscriptions_'.date('Y-m-d').'.csv';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die();
}

$csv_export = '';

$sql = "SELECT * FROM subscriptions";
$result = $conn->query($sql);

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