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
    <h1>Domain</h1>
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

<div class="container">
  <div class="row">   
    <div class="col-sm"> 
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Components
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">     
                <?php
                foreach ($db->query('SELECT DISTINCT c.NAME FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID') as $row)
                {
                    echo "<a class=\"dropdown-item\" href=\"#\">" . $row[0] . "</a>";
                }
                ?>      
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Characteristic
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">     
                <?php
                foreach ($db->query('SELECT DISTINCT c.NAME FROM DOMAIN d INNER JOIN Characteristic c ON d.ID = c.DOMAIN_ID') as $row)
                {
                    echo "<a class=\"dropdown-item\" href=\"#\">" . $row[0] . "</a>";
                }
                ?>      
            </div>
        </div>
    </div>
  </div>
</div>
    
    
    
    
    <?php
    foreach ($db->query('SELECT c.NAME AS Compnent FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID') as $row)
    {
        
    }
     ?>
    
<div class="container">
  <div class="row">     
    <div class="col-sm">        
      <table class="table">
        <thead>
            <tr>
            <th scope="col">Component</th>
            <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>      
            <?php
            foreach ($db->query('SELECT c.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID WHERE d.ID = 1;') as $row)
            {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "<td></tr>";
            }
            ?>           
        </tbody>
      </table>
    </div>     
      <div class="col-sm">        
      <table class="table">
        <thead>
            <tr>
            <th scope="col">Component</th>
            <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>       
            <?php
            foreach ($db->query('SELECT c.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID WHERE d.ID = 2;') as $row)
            {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "<td></tr>";
            }
            ?>           
        </tbody>
      </table>
    </div>      
      <div class="col-sm">     
      <table class="table">
        <thead>
            <tr>
            <th scope="col">Component</th>
            <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>     
            <?php
            foreach ($db->query('SELECT c.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID WHERE d.ID = 3;') as $row)
            {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "<td></tr>";
            }
            ?>         
        </tbody>
      </table>
    </div>
  </div>
</div>
    
    <div class="container">
  <div class="row">     
    <div class="col-sm">        
      <table class="table">
        <thead>
            <tr>
            <th scope="col">Characteristic</th>
            <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>      
            <?php
            foreach ($db->query('SELECT c.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID WHERE d.ID = 1;') as $row)
            {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "<td></tr>";
            }
            ?>           
        </tbody>
      </table>
    </div>     
      <div class="col-sm">        
      <table class="table">
        <thead>
            <tr>
            <th scope="col">Characteristic</th>
            <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>       
            <?php
            foreach ($db->query('SELECT c.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID WHERE d.ID = 2;') as $row)
            {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "<td></tr>";
            }
            ?>           
        </tbody>
      </table>
    </div>      
      <div class="col-sm">     
      <table class="table">
        <thead>
            <tr>
            <th scope="col">Characteristic</th>
            <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>     
            <?php
            foreach ($db->query('SELECT c.NAME, c.DESCRIPTION FROM DOMAIN d INNER JOIN CHARACTERISTIC c ON d.ID = c.DOMAIN_ID WHERE d.ID = 3;') as $row)
            {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "<td></tr>";
            }
            ?>         
        </tbody>
      </table>
    </div>
  </div>
</div>
    
</body>
</html>