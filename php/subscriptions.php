<?php
error_reporting(0);

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
    echo "<h5>Sorry, could not reach the website right now! Please try again later.</h5>";
    die();
}

$sql = "SELECT * FROM subscriptions";
$result = $conn->query($sql);
$row_no = 1;

echo "
    <table class='table table-striped table-hover'>
    <caption>List of subscriptions. Total: ".$result->num_rows."</caption>
    <thead class='thead-dark'>
        <tr>
        <th scope='col'>#</th>
        <th scope='col'>Name</th>
        <th scope='col'>Email</th>
        </tr>
    </thead>
    <tbody>
    ";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <th scope='row'>".$row_no."</th>
        <td>".$row["fname"]."</td>
        <td>".$row["email"]."</td>
      </tr>";
      $row_no++;
    }
}

echo "</tbody></table>";

$conn->close();
?>