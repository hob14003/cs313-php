<!DOCTYPE html>
<html lang="en">
    
<head>
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
                     echo "<script>alert(\"entered\")</script>";

    if($_GET["database"]) {
                     echo "<script>alert(\"entered if1\")</script>";

            $dbCmd = filter_var($_GET["database"]);
         if($dbCmd == "Insert"){
             echo "<script>alert(\"entered if2\")</script>";
             $charOrComp = filter_var($_POST["charOrComp"]);
             $domains = filter_var($_POST["domains[]"]);
             $name = filter_var($_POST["name"]);
             $desc = filter_var($_POST["desc"]);
                echo "<p>charOrComp = " . $charOrComp . "<br>domains = " . $domains . "<br>name = " . $name . "<br>desc = " . $desc . "</p>";        
             foreach($domains as $domain) {
                 echo "<script>alert(\"entered domain loop\")</script>";
             $db->query("INSERT INTO " . $charOrComp . "(DOMAIN_ID, NAME, DESCRIPTION) VALUES (" . $domain . ", " . $name . ", " . $desc . ");");
             }
         }
    }
//header("Location: 3DomainsHome.php");
?>
    </body>
</html>