<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "<h5>Sorry, could not reach the website right now! Please try again later.</h5>";
    die();
}

if (!isset($_GET['sort'])) {
  $sql = "SELECT *, formatCurrency(price) as 'value' FROM artwork";
} else {
  $sort = $_GET['sort'];
  $order = $_GET['order'];
  $sql = "SELECT *, formatCurrency(price) as 'value' FROM artwork ORDER BY ".$sort." ".$order;
}

$result = $conn->query($sql);
$row_no = 1;

echo "<table class='table table-striped table-hover'>
      <caption>List of artwork. Total: ".$result->num_rows."</caption>
      <thead class='thead-dark'>
          <tr>
          <th scope='col'>#</th>
          <th scope='col'>Name</th>
          <th scope='col'>Artist</th>
          <th scope='col'>Price</th>
          <th scope='col'>Type</th>
          <th scope='col'>Sold</th>
          <th scope='col'></th>
          </tr>
      </thead>
      <tbody>
      ";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr id='artwork".$row_no."'>
        <th scope='row'>".$row_no."</th>
        <td>".$row["aname"]."</td>
        <td>".$row["artist"]."</td>
        <td>".$row["value"]."</td>
        <td>".$row["atype"]."</td>";
        if ($row["sold"] == 1)
        echo "<td>Yes</td>";
        else echo "<td>No</td>";
        echo "<td>
          <input class='btn btn-danger' type='button' onclick='editArt(`artwork".$row_no."`)' value='Edit'/>
          <input class='btn btn-danger' type='button' onclick='deleteArt(`".$row["aname"]."`,`".$row["artist"]."`)' value='Delete'/>
        </td>
      </tr>";
      $row_no++;
    }
}

echo "</tbody></table>";

$conn->close();
?>