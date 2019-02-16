<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
  <title>3Domains Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>  
    
    <link rel="stylesheet" type="text/css" href="3Domain.css">
    
</head>
<body>
<?php
try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}
?>

<!-- LOGO -->
    <div class="container-fluid no-padding bg-drkCell">
        <img src="images/LOGO.jpg" class="img-fluid" alt="Responsive image">
    </div>
    
<!-- CELL IMAGE -->
<div class="container-fluid no-padding center">   
    <div class="col-md-12">
        <img src="images/blueCellsCrp.jpg" class="img-fluid crop height400" alt="Responsive image">
  </div>
</div>
    
   <!-- NAVBAR -->
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/02Prove/HomePage.php">CS 313 Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        
      <li class="nav-item">
        <a class="nav-link" href="3DomainsHome.php">Home <span class="sr-only">(current)</span></a>
      </li>
        
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Characteristics
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
                foreach ($db->query('SELECT DISTINCT c.NAME FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID') as $row)
                {
                    echo "<a class=\"dropdown-item\" href=\"FilteredData.php?characteristic=" . $row[0] . "\">" . $row[0] . "</a>";
                }
                ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="FilteredData.php?characteristic=All Characteristics">All</a>
        </div>
      </li>
        
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Components
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
                foreach ($db->query('SELECT DISTINCT c.NAME FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID') as $row)
                {
                    echo "<a class=\"dropdown-item\" href=\"FilteredData.php?component=" . $row[0] . "\">" . $row[0] . "</a>";
                }
                ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="FilteredData.php?component=All Components">All</a>
        </div>
      </li>
        
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Domains
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
                foreach ($db->query('SELECT DISTINCT NAME FROM DOMAIN') as $row)
                {
                    echo "<a class=\"dropdown-item\" href=\"FilteredData.php?domain=" . $row[0] . "\">" . $row[0] . "</a>";
                }
                ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="3DomainsHome.php">All</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Database
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="FilteredData.php?database=Insert">Insert</a>
            <a class="dropdown-item" href="FilteredData.php?database=Edit">Edit</a>
            <a class="dropdown-item" href="FilteredData.php?database=Delete">Delete</a>
        </div>
      </li>  
    </ul>
    <form action="FilteredData.php" method="get" class="form-inline my-2 my-lg-0">
      <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
    
    <!-- TABLES -->
    
    <!-- Characteristic View -->
    <?php

        if($_GET["characteristic"]) {

            echo "    
                <div class=\"container\">
                <div class=\"row\">     
                <div class=\"col-sm\">
                <h2>" . $_GET['characteristic'] . "</h2>
                <table class=\"table\">
                    <thead>
                        <tr>";
            if($_GET["characteristic"] == "All Characteristics") {
                echo"
                        <th scope=\"col\">Domain</th>
                        <th scope=\"col\">Characteristic</th>
                        <th scope=\"col\">Description</th>
                        <th scope=\"col\"></th>
                        <th scope=\"col\"></th>
                        </tr>
                    </thead>
                    <tbody>";
            
                echo "SELECT d.NAME, c.NAME, c.DESCRIPTION c.ID FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID;";
                        foreach ($db->query("SELECT d.NAME, c.NAME, c.DESCRIPTION, c.ID FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID;") as $row)
                        {
                            echo "<tr><td>" . $row[0] . "</td>
                            <td>" . $row[1] . "</td>
                            <td>" . $row[2] . "</td>
                            <td><a class=\"btn btn-primary\" href=\"FilteredData.php?database=Edit&table=CHARACTERISTIC&id=" . $row[3] . "&name=" . $row[0] . "&desc=" . $row[2] . "\" role=\"button\">Edit</a></td>
                            <td> <a class=\"btn btn-primary\" href=\"HandleSQL.php?database=Delete&table=CHARACTERISTIC&id=" . $row[3] . "\" role=\"button\">Delete</a></td>
                            </tr>";
                        }
                    }
                else {
                    echo "
                        <th scope=\"col\">Domain</th>
                        <th scope=\"col\">Description</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach ($db->query("SELECT d.NAME, c.DESCRIPTION, c.ID FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID WHERE c.NAME = " . "'" . $_GET["characteristic"] . "';") as $row)
                        {
                            echo "<tr><td>" . $row[0] . "</td>
                            <td>" . $row[1] . "</td>
                            <td><a class=\"btn btn-primary\" href=\"FilteredData.php?database=Edit&table=CHARACTERISTIC&id=" . $row[2] . "&name=" . $row[0] . "&desc=" . $row[1] . "\" role=\"button\">Edit</a></td>
                            <td> <a class=\"btn btn-primary\" href=\"HandleSQL.php?database=Delete&table=CHARACTERISTIC&id=" . $row[2] . "\" role=\"button\">Delete</a></td></tr>";               
                        }
                    }
            echo "</tbody>
                  </table>
                  </div>
                  </div>
                  </div>";
        }
    ?>
    
        <!-- Component View -->
    <?php

        if($_GET["component"]) {

            echo "    
                <div class=\"container\">
                <div class=\"row\">     
                <div class=\"col-sm\">
                <h2>" . $_GET['component'] . "</h2>
                <table class=\"table\">
                    <thead>
                        <tr>";
            if($_GET["component"] == "All Components") {
                echo"
                        <th scope=\"col\">Domain</th>
                        <th scope=\"col\">Component</th>
                        <th scope=\"col\">Description</th>
                        <th scope=\"col\"></th>
                        <th scope=\"col\"></th>
                        </tr>
                    </thead>
                    <tbody>";
            
                    
                        foreach ($db->query("SELECT d.NAME, c.NAME, c.DESCRIPTION, c.ID FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID;") as $row)
                        {
                            echo "<tr><td>" . $row[0] . "</td>
                            <td>" . $row[1] . "</td>
                            <td>" . $row[2] . "</td>
                            <td><a class=\"btn btn-primary\" href=\"FilteredData.php?database=Edit&table=COMPONENT&id=" . $row[3] . "&name=" . $row[0] . "&desc=" . $row[2] . "\" role=\"button\">Edit</a></td>
                            <td> <a class=\"btn btn-primary\" href=\"HandleSQL.php?database=Delete&table=COMPONENT&id=" . $row[3] . "\" role=\"button\">Delete</a></td>
                            </tr>";
                        }
                    }
                else {
                    echo "
                        <th scope=\"col\">Domain</th>
                        <th scope=\"col\">Description</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach ($db->query("SELECT d.NAME, c.DESCRIPTION, c.ID FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID WHERE c.NAME = " . "'" . $_GET["component"] . "';") as $row)
                        {
                            echo "<tr><td>" . $row[0] . "</td>
                            <td>" . $row[1] . "</td>
                            <td><a class=\"btn btn-primary\" href=\"FilteredData.php?database=Edit&table=COMPONENT&id=" . $row[2] . "&name=" . $row[0] . "&desc=" . $row[1] . "\" role=\"button\">Edit</a></td>
                            <td> <a class=\"btn btn-primary\" href=\"HandleSQL.php?database=Delete&table=COMPONENT&id=" . $row[2] . "\" role=\"button\">Delete</a></td></tr>";               
                        }
                    }
            echo "</tbody>
                  </table>
                  </div>
                  </div>
                  </div>";
        }
    ?>
    
    
    
    <!-- Domain View -->
    <?php
        if($_GET["domain"]) {
            echo "   
                <div class=\"container\">
                <div class=\"row\">     
                <div class=\"col-sm\">
                <h2>" . $_GET['domain'] . "</h2>
                <table class=\"table\">
                    <thead>
                        <tr>
                        <th scope=\"col\">Characteristic</th>
                        <th scope=\"col\">Description</th>
                        </tr>
                    </thead>
                    <tbody>";
            
                    foreach ($db->query("SELECT c.NAME, c.DESCRIPTION, c.ID FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID WHERE D.NAME = " . "'" . $_GET["domain"] . "';") as $row)
                    {
                        echo "<tr><td>" . $row[0] . "</td>
                        <td>" . $row[1] . "</td>
                        <td><a class=\"btn btn-primary\" href=\"FilteredData.php?database=Edit&table=CHARACTERISTIC&id=" . $row[2] . "&name=" . $_GET["domain"] . "&desc=" . $row[1] . "\" role=\"button\">Edit</a></td>
                            <td> <a class=\"btn btn-primary\" href=\"HandleSQL.php?database=Delete&table=CHARACTERISTIC&id=" . $row[2] . "\" role=\"button\">Delete</a></td>
                            </tr>";

                    }
            echo "</tbody>
                  <thead>
                        <tr>
                        <th scope=\"col\">Component</th>
                        <th scope=\"col\">Description</th>
                        </tr>
                    </thead>
                    <tbody>";
            
                    foreach ($db->query("SELECT c.NAME, c.DESCRIPTION, c.ID FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID WHERE d.NAME = " . "'" . $_GET["domain"] . "';") as $row)
                    {
                        echo "<tr><td>" . $row[0] . "</td>
                        <td>" . $row[1] . "</td>
                        <td><a class=\"btn btn-primary\" href=\"FilteredData.php?database=Edit&table=COMPONENT&id=" . $row[2] . "&name=" . $_GET["domain"] . "&desc=" . $row[1] . "\" role=\"button\">Edit</a></td>
                        <td> <a class=\"btn btn-primary\" href=\"HandleSQL.php?database=Delete&table=COMPONENT&id=" . $row[2] . "\" role=\"button\">Delete</a></td>
                            </tr>"
                    }
            echo "</tbody>
                  </table>
                  </div>
                  </div>
                  </div>";
        }
    ?>
    
    <!-- Search View -->
    <?php
        if($_GET["search"]) {
            $find = filter_var($_GET["search"]);
            echo "   
                <div class=\"container\">
                <div class=\"row\">     
                <div class=\"col-sm\">
                <h2>" . $find . "</h2><br>
                <h4>Domain Search</h4>
                <table class=\"table\">
                    <thead>
                        <tr>
                        <th scope=\"col\">Domain</th>
                        </tr>
                    </thead>
                    <tbody>";
            
                    foreach ($db->query("SELECT d.NAME FROM DOMAIN d WHERE d.NAME = " . "'" . $find . "';") as $row)
                    {
                        echo "<tr><td>" . $row[0] . "</td></tr>";
                    }
            echo "</tbody>
                  </table>
                  </div>
                  </div>
                  </div>";
            
             echo "   
                <div class=\"container\">
                <div class=\"row\">     
                <div class=\"col-sm\">
                <br><h4>Characteristic Search</h4>
                <table class=\"table\">
                    <thead>
                        <tr>
                        <th scope=\"col\">Domain</th>
                        <th scope=\"col\">Characteristic</th>
                        <th scope=\"col\">Description</th>
                        </tr>
                    </thead>
                    <tbody>";
            
                    foreach ($db->query("SELECT d.NAME, c.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID WHERE c.NAME = " . "'" . $find . "';") as $row)
                    {
                        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>";
                    }
            echo "</tbody>
                  </table>
                  </div>
                  </div>
                  </div>";
            
             echo "   
                <div class=\"container\">
                <div class=\"row\">     
                <div class=\"col-sm\">
                <br><h4>Component Search</h4>
                <table class=\"table\">
                    <thead>
                        <tr>
                        <th scope=\"col\">Domain</th>
                        <th scope=\"col\">Component</th>
                        <th scope=\"col\">Description</th>
                        </tr>
                    </thead>
                    <tbody>";
            
                    foreach ($db->query("SELECT d.NAME, c.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID WHERE c.NAME = " . "'" . $find . "';") as $row)
                    {
                        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>";
                    }
            echo "</tbody>
                  </table>
                  </div>
                  </div>
                  </div>";
        }
    ?>
    
    <!-- Database View -->
    <?php
        if($_GET["database"]) {
            $dbCmd = filter_var($_GET["database"]);
            echo "   
                <div class=\"container\">
                <div class=\"row\">     
                <div class=\"col-sm\">
                <h2>" . $dbCmd . "</h2>";
            if($dbCmd == "Insert"){
                echo "
                <form action=\"HandleSQL.php?database=Insert\" method=\"post\">
                    
                    Domain: <br><input type=\"checkbox\" name=\"domains[]\"   value=1>Bacteria<br>
                    <input type=\"checkbox\" name=\"domains[]\" value=2>Archaea<br>
                    <input type=\"checkbox\" name=\"domains[]\" value=3>Eukarya<br>
                
                    Type: <br><input type=\"radio\" name=\"charOrComp\" value=\"CHARACTERISTIC\">Characteristic<br>
                    <input type=\"radio\" name=\"charOrComp\" value=\"COMPONENT\">Component<br>
                    
                    Name: <input type=\"text\" name=\"name\"><br>
                    Description: <input type=\"text\" name=\"desc\"><br>
                    <input type=\"submit\" value=\"Submit\">
                </form>";                
            }
            if($dbCmd == "Edit"){
				$id = filter_var($_GET["id"]);
                $table = filter_var($_GET["table"]);
                $desc = filter_var($_GET["desc"]);
                //$name = filter_var($_GET["name"]);
                
                foreach ($db->query("SELECT c.NAME FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID WHERE c.ID = " . "'" . $id . "';") as $row)
                {
                    $name = $row[0];
                }
                
                
                echo "<script>alert(entered foreach in char db)</script>";
                  
                echo "
                <form action=\"HandleSQL.php?database=Edit&id=" . $id . "&table=" . $table . "\" method=\"post\">
                    
                    Name: <input type=\"text\" name=\"name\" value=\"" . $name . "\"><br>
                    Description: <input type=\"text\" name=\"desc\" value=\"" . $desc . "\"><br>
                    <input type=\"submit\" value=\"Submit\">
                </form>"; 
            }
            echo "    
                </div>
                </div>
                </div>";
        }
    ?>    
    
    
    
        <!-- CELL FOOTER -->
<div class="container-fluid no-padding">
  <div class="row">     
    <div class="col-md-12">
        <img src="images/blueCellsSprCrp.jpg" class="img-fluid crop" alt="Responsive image">
    </div>
      <div class="col-md-12">
          <h1 class="bg-dark text-dark">.</h1>
    </div>
  </div>
</div>
    
    
</body>
</html>