<?php
ob_start();
include('authenticate.php');
$auth = ob_get_contents();
ob_end_clean();

if ($auth == "0") {
  die();
}

$title = (isset($_POST['title']) ? $_POST['title']: '');
$body = (isset($_POST['body']) ? $_POST['body']: '');

$path = '../blog/' . $title . '.txt';
file_put_contents($path, $body);
?>