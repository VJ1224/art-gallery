<?php
session_start();
 
if(isset($_SESSION["username"]) || $_SESSION["username"] === true){
    echo "Welcome, ".$_SESSION["username"];
}
?>