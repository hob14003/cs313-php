<?php
session_start();
if (!isset($_SESSION["user"])) {
	header("Location: login.html"); /* Redirect browser */
	exit();
}
echo "array_merge13";
//$cart = $_SESSION["cart"];
//$elements = $_SESSION["cart"];
$elementsP = $_POST["elements"];

$_SESSION["cart"] = $_POST["elements"];//array_merge($elements,$cart);

header("Location: viewCart.php");
?>
