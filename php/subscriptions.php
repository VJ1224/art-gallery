<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM subscriptions";
$result = $conn->query($sql);
$rows = 1;

echo "<h2 id='title'>Subscriptions</h2>
    <table class='table table-striped table-hover'>
    <caption>List of subscriptions.</caption>
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
        <th scope='row'>".$rows."</th>
        <td>".$row["fname"]."</td>
        <td>".$row["email"]."</td>
      </tr>";
      $rows++;
    }
}

echo "</tbody></table>";

$conn->close();
?>