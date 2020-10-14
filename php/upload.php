<?php
ob_start();
include('authenticate.php');
$auth = ob_get_contents();
ob_end_clean();

if ($auth == "0") {
  die();
}

$file_name = $_FILES['image']['name'];
$temp_name = $_FILES['image']['tmp_name'];
$dir = '../images/art/';

if (isset($file_name) and !empty($file_name)) {
    move_uploaded_file($temp_name, $dir.$file_name);
}
?>