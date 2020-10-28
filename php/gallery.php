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

$type = $_GET['type'];
$order = $_GET['order'];

$sql = "SELECT formatCurrency(price) as 'value', aname, artist FROM artwork WHERE atype='".$type."' AND sold=0 ORDER BY price ".$order;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='card-columns'>";
    while ($row = $result->fetch_assoc()) {
        echo    "<div class='card bg-light mb-3 shadow'>
                    <img src='images/art/".$row["aname"]." ".$row["artist"].".jpg' class='card-img-top img-fluid'>
                    <div class='card-body'>
                        <h5 class='card-title'>".$row["aname"]."</h5>
                        <h6 class='card-subtitle mb-2 text-muted'>".$row["artist"]."</h6>
                        <p class='card-text'>Price: ".$row["value"]."</p>
                        <a href='#' class='btn btn-danger' onclick='order(`".$row["aname"]."`,`".$row["artist"]."`)'>Buy Now</a>
                    </div>
                </div>";
    }
    echo "</div>";
} else {
    echo "<h5>No artwork available right now. Check back soon!</h5>";
}

$conn->close();
?>