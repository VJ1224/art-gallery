<?php
session_start();
 
if(isset($_SESSION["username"]) || $_SESSION["loggedin"] === true){
    echo "Welcome, ".$_SESSION["username"];
}
?>