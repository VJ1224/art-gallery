<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cia2_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die();
}

if (isset($_GET['artist'])) {
    $name = $_GET['artist'];

    $sql = "SELECT aname, mobile, email, location FROM artist WHERE aname='".$name."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo "<div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                    <h5 class='modal-title'>" . $row["aname"] . "</h5>
                    <button type='button' class='close' data-dismiss='modal'>
                        <span>&times;</span>
                    </button>
                    </div>
                    <div class='modal-body'>" .
                    'Phone Number: ' . $row["mobile"] .
                    '<br>Email: ' . $row["email"] .
                    '<br>Location: ' . $row["location"]
                    . "</div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    </div>
                </div>
            </div>";
    }
} else {
    $sql = "SELECT aname FROM artist";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='".$row["aname"]."' selected>".$row["aname"]."</option>";
        }
    }
}

$conn->close();
?>