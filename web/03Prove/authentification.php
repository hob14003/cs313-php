<?php
$username = htmlspecialchars($_POST["username"]);
session_start();
$_SESSION["user"] = $username;
$_SESSION["cart"] = array();
header("Location: browse.php");
?>