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
  die("Connection failed: " . $conn->connect_error);
}

$sort = $_GET['sort'];
$order = $_GET['order'];

if ($sort == 'default') {
  $sql = "SELECT * FROM artwork";
} else {
  $sql = "SELECT * FROM artwork ORDER BY ".$sort." ".$order;
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
          <th scope='col'></th>
          </tr>
      </thead>
      <tbody>
      ";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <th scope='row'>".$row_no."</th>
        <td>".$row["aname"]."</td>
        <td>".$row["artist"]."</td>
        <td>".$row["price"]."</td>
        <td>".$row["atype"]."</td>
        <td><input class='btn btn-danger' type='button' onclick='deleteArt(`".$row["aname"],"`,`".$row["artist"]."`)' value='Delete'/></td>
      </tr>";
      $row_no++;
    }
}

echo "</tbody></table>";

$conn->close();
?>