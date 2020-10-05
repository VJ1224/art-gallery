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

$group = $_GET['group'];

$sql = "SELECT FORMAT(SUM(price),0) AS 'value', artist, atype FROM artwork GROUP BY ".$group;

$result = $conn->query($sql);
$row_no = 1;

echo "<table class='table table-striped table-hover'>
      <caption>List of artwork. Total: ".$result->num_rows."</caption>
      <thead class='thead-dark'>
          <tr>
          <th scope='col'>#</th>
          ";
          if ($group == 'artist') echo "<th scope='col'>Artist</th>";
          else echo "<th scope='col'>Type</th>";
          echo "<th scope='col'>Value</th>
          </tr>
      </thead>
      <tbody>
      ";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <th scope='row'>".$row_no."</th>";
        if ($group == 'artist') echo "<td>".$row["artist"]."</td>";
        else echo "<td>".$row["atype"]."</td>";
        echo "<td>₹".$row["value"]."</td>
      </tr>";
      $row_no++;
    }
}

echo "</tbody></table>";

$conn->close();
?>