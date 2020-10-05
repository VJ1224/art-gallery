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

$search = $_GET['search'];
$category = $_GET['category'];
$row_no = 1;

$sql = "SELECT FORMAT(price, 0) as 'price', aname, atype, artist FROM artwork WHERE ".$category." LIKE '%".$search."%'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

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
        <td>₹".$row["price"]."</td>
        <td>".$row["atype"]."</td>
        <td><input class='btn btn-danger' type='button' onclick='deleteArt(`".$row["aname"],"`,`".$row["artist"]."`)' value='Delete'/></td>
      </tr>";
      $row_no++;
    }
}

echo "</tbody></table>";

$conn->close();
?>