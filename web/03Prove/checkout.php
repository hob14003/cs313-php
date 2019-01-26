<?php
session_start();
// User login
if (!isset($_SESSION["user"])) {
	header("Location: login.html"); /* Redirect browser */
	exit();
}
$username = $_SESSION["user"];
$elements = $_SESSION["elements"];
$elementsA = $_POST["elements"];
$cart = $_SESSION["cart"];
$_SESSION["setElements"] = $_POST["elements"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Periodically Shopping</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
    <div class="d-flex"><link rel="stylesheet" type="text/css" href="home.css"></div>  
    
    <link rel="stylesheet" type="text/css" href="shopping.css">
</head>
    
    
<body>

    <!-- Top Bar -->
    <div class="container-fluid no-padding img-container">
  <div class="row">
    <div class="col-md-12">
      <img src="topBar.jpg" alt="TopBar" class="img-responsive"/>
    </div>
  </div>
</div>
    
    
    
    
 <!-- Nav Bar -->    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><span class="c-green">P</span><span class="c-blue">E</span><span class="c-purple">RIODI</span><span class="c-gold">C</span><span class="c-teal">A</span><span class="c-ba">L</span><span class="c-red">L</span><span class="c-pink">Y</span> <span class="c-pink">SH</span><span class="c-purple">OPPI</span><span class="c-green">N</span><span class="c-pink">G</span></a>
        
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/02Prove/HomePage.php">CS 313 Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="browse.php">Browse</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="viewCart.php">View Cart</a>
      </li>
    </ul>
  </div>
</nav>
    
    
    
    
        <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-push-2">
    <form action="confirmation.php" method="post">
            <h1>Checkout</h1>
    <?php
                        $cartSize = sizeof($cart);
                        $cartCount = count($cart);
                        $total = 0;
                    if($cartCount != 0) {
                             echo "<form action=\"checkout.php\" method=\"post\">";
                             echo" <table class=\"table table-dark\">
                                    <thead>
                                    <tr>
                                        <th scope=\"col\">Element</th>
                                        <th scope=\"col\">Image</th>
                                        <th scope=\"col\">Price/MOLE</th>
                                    </tr>
                                    </thead>
                                    <tbody>";
                        foreach ($cart as $item) {
                            switch ($item) {
                                        case "H":
                                            echo '<tr><th scope="row">01 Hydrogen</th>';
                                            echo '<td><img src="https://sciencenotes.org/wp-content/uploads/2015/05/Hydrogenglow.jpg" alt="Hydrogen" height="100" width=auto></td>';
                                            echo '<td>$2.59</td>';
                                            $total += 2.59;
                                            break;
                                        case "He":
                                            echo '<tr><th scope="row">02 Helium</th>';
                                            echo '<td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8gImJHDy1V_JiCxtTGYvitUpETFtOIbU48X1IWL9PQKhlmd7_" alt="Helium" height="100" width="100"></td>';
                                            echo '<td>$0.19</td>';
                                            $total += 0.19;
                                            break;
                                    
                                    case "Li":
                                            echo '<tr><th scope="row">03 Lithium</th>';
                                            echo '<td><img src="imLi.JPG" alt="Lithium" height="100" width=auto></td>';
                                            echo '<td>$7.99</td>';
                                            $total += 7.99;
                                            break;
                                        case "Be":
                                            echo '<tr><th scope="row">04 Beryllium</th>';
                                            echo '<td><img src="imBe.jpg" alt="Beryllium" height="100" width=auto></td>';
                                            echo '<td>$8.59</td>';
                                            $total += 8.59;
                                            break;
                                        case "Si":
                                            echo '<tr><th scope="row">14 Silicon</th>';
                                            echo '<td><img src="imSi.JPG" alt="Silicon" height="100" width=auto></td>';
                                            echo '<td>$3.59</td>';
                                            $total += 3.59;
                                            break;
                                        case "Zr":
                                            echo '<tr><th scope="row">40 Zirconium</th>';
                                            echo '<td><img src="imZr.JPG" alt="Zirconium" height="100" width=auto></td>';
                                            echo '<td>$5.07</td>';
                                            $total += 5.07;
                                            break;
                                        case "Ba":
                                            echo '<tr><th scope="row">56 Barium</th>';
                                            echo '<td><img src="https://storybookstorage.s3.amazonaws.com/items/images/000/373/355/original/20160504-9-1ggzndt.JPG?1462374995" alt="Barium" height="100" width=auto></td>';
                                            echo '<td>$11.42</td>';
                                            $total += 11.42;
                                            break;
                                        case "Tb":
                                            echo '<tr><th scope="row">65 Terbium</th>';
                                            echo '<td><img src="http://www.theodoregray.com/PeriodicTable/Samples/065.5/s15s.JPG" alt="Terbium" height="100" width=auto></td>';
                                            echo '<td>$56.78</td>';
                                            $total += 56.78;
                                            break;
                                        case "Lu":
                                            echo '<tr><th scope="row">71 Lutetium</th>';
                                            echo '<td><img src="https://list-english.ru/img/artpic/nagl/chem/71.JPG" alt="Lutetium" height="100" width=auto></td>';
                                            echo '<td>$97.12</td>';
                                            $total += 97.12;
                                            break;
                                }                                    
                            } //foreach close
                        echo "<tr><td></td><td></td><td>Total: $$total</td>
                        <tr><td></td><td>Shipping Address: <input type=\"text\" name=\"address\" value=\"\"></td><td></td>
                        
                        <tr><td></td><td><a href=\"viewCart.php\" class=\"btn btn-dark\">Return to Cart</a></td><td><input class=\"btn btn-dark\" type=\"submit\" value=\"Purchase\"></td>
                        <tr>
                        </table>";
                        } else {
                            echo "<h4>Your cart is empty. Please click the Continue Shopping button below</h4><a href=\"browse.php\" class=\"btn btn-dark\">Continue Shopping</a>";
                        }
                    ?>
    </form>
            </div>
            </div>
    </div>
    
    
    
    <!-- Bottom Bar -->
    <div class="container-fluid no-padding img-container">
  <div class="row">
    <div class="col-md-12">
      <img src="topBar.jpg" alt="TopBar" class="img-responsive"/>
    </div>
  </div>
</div>
    
    </body>
</html>