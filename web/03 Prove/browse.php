<?php
session_start();
// User login
if (!isset($_SESSION["user"])) {
	header("Location: login.html"); /* Redirect browser */
	exit();
}
$username = $_SESSION["user"];
//$elements = $_SESSION["elements"];
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
    <div class="d-flex"><link rel="stylesheet" type="text/css" href="shopping.css"></div>  
    
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
        <a class="nav-link" href="/HomePage.php">CS 313 Home </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="browse.php">Browse <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="viewCart.php">View Cart</a>
      </li>
    </ul>
  </div>
</nav>
    
    
    
    
    


    <!-- Table with Elements for Sale -->
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-push-2">
                <h1>Browse</h1>
                <form action="addItems.php" method="post">
                    <table class="table table-dark">
                       <thead>
                         <tr>
                           <th scope="col">Element</th>
                           <th scope="col">Image</th>
                           <th scope="col">Price/MOLE</th>
                           <th scope="col">Add to Cart</th>
                         </tr>
                       </thead>
                       <tbody>
                         <tr>
                           <th scope="row">01 Hydrogen</th>
                           <td><img src="https://sciencenotes.org/wp-content/uploads/2015/05/Hydrogenglow.jpg" alt="Hydrogen" height="100" width=auto></td>
                           <td>$2.59</td>
                           <td><input type="checkbox" name="elements[]" value="H"><br></td>
                         </tr>
                         <tr>
                           <th scope="row">02 Helium</th>
                           <td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8gImJHDy1V_JiCxtTGYvitUpETFtOIbU48X1IWL9PQKhlmd7_" alt="Helium" height="100" width="100"></td>
                           <td>$0.19</td>
                           <td><input type="checkbox" name="elements[]" value="He"><br></td>
                         </tr>
                         <tr>
                           <th scope="row">03 Lithium</th>
                           <td><img src="imLi.JPG" alt="Lithium" height="100" width=auto></td>
                           <td>$7.99</td>
                           <td><input type="checkbox" name="elements[]" value="Li"><br></td>
                         </tr>
                         <tr>
                           <th scope="row">04 Beryllium</th>
                           <td><img src="imBe.jpg" alt="Beryllium" height="100" width=auto></td>
                           <td>$8.59</td>
                           <td><input type="checkbox" name="elements[]" value="Be"><br></td>
                         </tr>
                         <tr>
                           <th scope="row">14 Silicon</th>
                           <td><img src="imSi.JPG" alt="Silicon" height="100" width=auto></td>
                           <td>$3.59</td>
                           <td><input type="checkbox" name="elements[]" value="Si"><br></td>
                         </tr>
                         <tr>
                           <th scope="row">40 Zirconium</th>
                           <td><img src="imZr.JPG" alt="Zirconium" height="100" width=auto></td>
                           <td>$5.07</td>
                           <td><input type="checkbox" name="elements[]" value="Zr"><br></td>
                         </tr>
                         <tr>
                           <th scope="row">56 Barium</th>
                           <td><img src="imBa.jpg" alt="Barium" height="100" width=auto></td>
                           <td>$11.42</td>
                           <td><input type="checkbox" name="elements[]" value="Ba"><br></td>
                         </tr>
                         <tr>
                           <th scope="row">65 Terbium</th>
                           <td><img src="http://www.theodoregray.com/PeriodicTable/Samples/065.5/s15s.JPG" alt="Terbium" height="100" width=auto></td>
                           <td>$56.78</td>
                           <td><input type="checkbox" name="elements[]" value="Tb"><br></td>
                         </tr>
                         <tr>
                           <th scope="row">71 Lutetium</th>
                           <td><img src="https://list-english.ru/img/artpic/nagl/chem/71.JPG" alt="Lutetium" height="100" width=auto></td>
                           <td>$97.12</td>
                           <td><input type="checkbox" name="elements[]" value="Lu"><br></td>
                         </tr>
                         <tr>
                           <th scope="row"></th>
                           <td></td>
                           <td></td>
                           <td><input class="btn-dark" type="submit" value="Add to Cart"></td>
                         </tr>                      
                       </tbody>
                    </table>
                
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