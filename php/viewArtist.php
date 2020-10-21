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
    echo "<h5>Sorry, could not reach the website right now! Please try again later.</h5>";
    die();
}

$sql = "SELECT formatCurrency(SUM(price)) AS 'value', artist, COUNT(*) AS 'total', mobile, email, location FROM artwork INNER JOIN artist ON artwork.artist = artist.aname GROUP BY artist";
$result = $conn->query($sql);
$row_no = 1;

echo "<table class='table table-striped table-hover'>
      <caption>List of artists. Total: ".$result->num_rows."</caption>
      <thead class='thead-dark'>
          <tr>
          <th scope='col'>#</th>
          <th scope='col'>Name</th>
          <th scope='col'>Phone Number</th>
          <th scope='col'>Email</th>
          <th scope='col'>Location</th>
          <th scope='col'>Total</th>
          <th scope='col'>Value</th>
          </tr>
      </thead>
      <tbody>
      ";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr id='row".$row_no."'>
        <th scope='row'>".$row_no."</th>
        <td>".$row["artist"]."</td>
        <td>".$row["mobile"]."</td>
        <td>".$row["email"]."</td>
        <td>".$row["location"]."</td>
        <td>".$row["total"]."</td>
        <td>".$row["value"]."</td>
      </tr>";
      $row_no++;
    }
}

echo "</tbody></table>";

$conn->close();
?>