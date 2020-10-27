<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die();
}

$count = 5;

$stmt = $conn->prepare("CALL randomArt(?, @aname, @artist)");
$stmt->bind_param("i", $count);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {    
    echo "<ol class='carousel-indicators'>";
    for ($i = 0; $i < $result->num_rows; $i++) {
        echo "<li data-target='#imageCarousel' data-slide-to='".$i."'></li>";
    }
    echo "</ol>";

    echo "<div class='carousel-inner'>";
    $row_num = 0;
    while ($row = $result->fetch_assoc()) {
        $image = $row["aname"]." ".$row["artist"];
        if ($row_num == 0) {
            echo "<div class='carousel-item active' style='height:24rem;'>
                <img src='images/art/".$image.".jpg' class='d-block h-100' alt=".$image." style='margin: auto;'>
                <div class='carousel-caption d-none d-md-block'>
                    <h5>".$row["aname"]."</h5>
                    <p>".$row["artist"]."</p>
                </div>
                </div>";
        } else {
            echo "<div class='carousel-item' style='height:24rem;'>
                <img src='images/art/".$image.".jpg' class='d-block h-100' alt=".$image." style='margin: auto;'>
                <div class='carousel-caption d-none d-md-block'>
                    <h5>".$row["aname"]."</h5>
                    <p>".$row["artist"]."</p>
                </div>
                </div>";
        }

        $row_num++;
    }
    echo "</div>
    <a class='carousel-control-prev' id='carousel-control' href='#imageCarousel' data-slide='prev'>
        <span class='carousel-control-prev-icon'></span>
    </a>
    <a class='carousel-control-next' id='carousel-control' href='#imageCarousel' role='button' data-slide='next'>
        <span class='carousel-control-next-icon'></span>
    </a>";
}

$conn->close();
?>