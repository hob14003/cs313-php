<?php
session_start();
// User login
if (!isset($_SESSION["user"])) {
	header("Location: login.html"); /* Redirect browser */
	exit();
}
$cart = $_SESSION["cart"];
$remove = $_POST["remove"];

foreach($remove as $item) {
    switch ($item) {
        case "Remove H":
            $key = array_search('H', $cart);
            unset($_SESSION["cart"][$key]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]); 
            break;
        case "Remove He":
            $key = array_search('He', $cart);
            unset($_SESSION["cart"][$key]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]); 
            break;
        case "Remove Li":
            $key = array_search('Li', $cart);
            unset($_SESSION["cart"][$key]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]); 
            break;
        case "Remove Be":
            $key = array_search('Be', $cart);
            unset($_SESSION["cart"][$key]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]); 
            break;
        case "Remove Si":
            $key = array_search('Si', $cart);
            unset($_SESSION["cart"][$key]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]); 
            break;
        case "Remove Zr":
            $key = array_search('Zr', $cart);
            unset($_SESSION["cart"][$key]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]); 
            break;
        case "Remove Ba":
            $key = array_search('Ba', $cart);
            unset($_SESSION["cart"][$key]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]); 
            break;
        case "Remove Tb":
            $key = array_search('Tb', $cart);
            unset($_SESSION["cart"][$key]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]); 
            break;
        case "Remove Lu":
            $key = array_search('Lu', $cart);
            unset($_SESSION["cart"][$key]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]); 
            break;
    }
}
header("Location: viewCart.php");

?>