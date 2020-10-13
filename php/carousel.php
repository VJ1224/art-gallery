<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("CALL randomArt(@p0, @p1)");

if ($result->num_rows > 0) {    
    echo "<ol class='carousel-indicators'>";
    for ($i = 0; $i < $result->num_rows; $i++) {
        echo "<li data-target='#imageCarousel' data-slide-to='".$i."'></li>";
    }
    echo "</ol>";

    echo "<div class='carousel-inner' style='background-color: #3e4149;'>";
    $row_num = 0;
    while ($row = $result->fetch_row()) {
        $image = $row[0]." ".$row[1];
        if ($row_num == 0) {
            echo "<div class='carousel-item active' style='height:24rem;' >
                <img src='images/art/".$image.".jpg' class='d-block h-100' alt=".$image." style='margin: auto;'>
                <div class='carousel-caption d-none d-md-block'>
                    <h5>".$row[0]."</h5>
                    <p>".$row[1]."</p>
                </div>
                </div>";
        } else {
            echo "<div class='carousel-item' style='height:24rem;'>
                <img src='images/art/".$image.".jpg' class='d-block h-100' alt=".$image." style='margin: auto;'>
                <div class='carousel-caption d-none d-md-block'>
                    <h5>".$row[0]."</h5>
                    <p>".$row[1]."</p>
                </div>
                </div>";
        }

        $row_num++;
    }
    echo "</div>
    <a class='carousel-control-prev' href='#imageCarousel' data-slide='prev'>
        <span class='carousel-control-prev-icon'></span>
    </a>
    <a class='carousel-control-next' href='#imageCarousel' role='button' data-slide='next'>
        <span class='carousel-control-next-icon'></span>
    </a>";
}

$conn->close();
?>