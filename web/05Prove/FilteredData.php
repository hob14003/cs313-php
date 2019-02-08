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
    
    <link rel="stylesheet" type="text/css" href="home.css">
    
</head>
<body>
    <h1>3Domains</h1>
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

    <!-- NAVBAR -->
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">3Domains</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        
      <li class="nav-item active">
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
                    echo "<a class=\"dropdown-item\" href=\"#\">" . $row[0] . "</a>";
                }
                ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">All</a>
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
                    echo "<a class=\"dropdown-item\" href=\"#\">" . $row[0] . "</a>";
                }
                ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">All</a>
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
                    echo "<a class=\"dropdown-item\" href=\"#\">" . $row[0] . "</a>";
                }
                ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">All</a>
        </div>
      </li>
        
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
    
    
    
    <!-- TABLES -->
    
    <?php
        if($_GET["characteristic"]) {
            echo "    
                <div class=\"container\">
                <div class=\"row\">     
                <div class=\"col-sm\">
                <h2>" . $_GET['characteristic'] . "</h2>
                <table class=\"table\">
                    <thead>
                        <tr>
                        <th scope=\"col\">Domain</th>
                        <th scope=\"col\">Description</th>
                        </tr>
                    </thead>
                    <tbody>";
            
                    foreach ($db->query("SELECT d.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID WHERE c.NAME = " . "'" . $_GET["characteristic"] . "';") as $row)
                    {
                        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";
                    }
            echo "</tbody>
                  </table>
                  </div>
                  </div>
                  </div>";
        }
    ?>
    
    <?php
        if($_GET["component"]) {
            echo "   
                <div class=\"container\">
                <div class=\"row\">     
                <div class=\"col-sm\">
                <h2>" . $_GET['component'] . "</h2>
                <table class=\"table\">
                    <thead>
                        <tr>
                        <th scope=\"col\">Domain</th>
                        <th scope=\"col\">Description</th>
                        </tr>
                    </thead>
                    <tbody>";
            
                    foreach ($db->query("SELECT d.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID WHERE c.NAME = " . "'" . $_GET["component"] . "';") as $row)
                    {
                        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";
                    }
            echo "</tbody>
                  </table>
                  </div>
                  </div>
                  </div>";
        }
    ?>
    
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
                        <th scope=\"col\">Domain</th>
                        <th scope=\"col\">Description</th>
                        </tr>
                    </thead>
                    <tbody>";
            
                    foreach ($db->query("SELECT d.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID WHERE D.NAME = " . "'" . $_GET["domain"] . "';") as $row)
                    {
                        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";
                    }
            echo "</tbody>
                  <thead>
                        <tr>
                        <th scope=\"col\">Domain</th>
                        <th scope=\"col\">Description</th>
                        </tr>
                    </thead>
                    <tbody>";
            
                    foreach ($db->query("SELECT d.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID WHERE d.NAME = " . "'" . $_GET["domain"] . "';") as $row)
                    {
                        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";
                    }
            echo "</tbody>
                  </table>
                  </div>
                  </div>
                  </div>";
        }
    ?>
    
    
    
</body>
</html>