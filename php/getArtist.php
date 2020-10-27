<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die();
}

$sql = "SELECT aname FROM artist";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='".$row["aname"]."' selected>".$row["aname"]."</option>";
    }
}

$conn->close();
?>