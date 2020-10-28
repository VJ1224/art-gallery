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
    die();
}

$search = "%".$_GET['search']."%";
$category = $_GET['category'];
$row_no = 1;

$sql = "SELECT *, formatCurrency(price) as 'price' FROM artwork WHERE ".$category." LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();

if (isset($_GET['admin'])) {
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
          echo "<tr id='row".$row_no."'>
          <th scope='row'>".$row_no."</th>
          <td>".$row["aname"]."</td>
          <td>".$row["artist"]."</td>
          <td>".$row["price"]."</td>
          <td>".$row["atype"]."</td>";
          if ($row["sold"] == 1)
          echo "<td>Yes</td>";
          else echo "<td>No</td>";
          echo "<td>
            <input class='btn btn-danger' type='button' onclick='editArt(`row".$row_no."`)' value='Edit'/>  
            <input class='btn btn-danger' type='button' onclick='deleteArt(`".$row["aname"]."`,`".$row["artist"]."`)' value='Delete'/>
          </td>
        </tr>";
        $row_no++;
      }
  }

  echo "</tbody></table>";
} else {
  if ($result->num_rows > 0) {
    echo "<div class='card-columns'>";
    while ($row = $result->fetch_assoc()) {
        echo    "<div class='card bg-light mb-3 shadow'>
                    <img src='images/art/".$row["aname"]." ".$row["artist"].".jpg' class='card-img-top img-fluid'>
                    <div class='card-body'>
                        <h5 class='card-title'>".$row["aname"]."</h5>
                        <h6 class='card-subtitle mb-2 text-muted'>".$row["artist"]."</h6>
                        <p class='card-text'>Price: ".$row["price"]."</p>
                        <a href='#' class='btn btn-danger' onclick='order(`".$row["aname"]."`,`".$row["artist"]."`)'>Buy Now</a>
                    </div>
                </div>";
    }
    echo "</div>";
  } else {
      echo "<h5>No artwork available right now. Check back soon!</h5>";
  }
}

$conn->close();
?>