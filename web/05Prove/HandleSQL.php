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

    if($_GET["database"]) {
            $dbCmd = filter_var($_GET["database"]);
         if($dbCmd == "Insert"){
             $charOrComp = $_GET["charOrComp"];
             $domains = $_GET["domains"];
             $name = $_GET["name"];
             $desc = $_GET["desc"];
             
             foreach($domains as $domain) {
             $db->query("INSERT INTO " . $charOrComp . "(DOMAIN_ID, NAME, DESCRIPTION) VALUES (" . $domain . ", " . $name . ", " . $desc . ");");
             }
         }
    }
header("Location: 3DomainsHome.php");
?>