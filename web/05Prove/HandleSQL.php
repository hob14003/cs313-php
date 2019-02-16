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
    if($_GET["database"]) {

            $dbCmd = filter_var($_GET["database"]);
        //INSERT
         if($dbCmd == "Insert"){
             echo "<script>alert(\"entered if2\")</script>";
             $charOrComp = filter_var($_POST["charOrComp"]);
             $domains = $_POST["domains"];
             $name = filter_var($_POST["name"]);
             $desc = filter_var($_POST["desc"]);
                echo "<p>charOrComp = " . $charOrComp . "<br>domains = " . $domains . "<br>name = " . $name . "<br>desc = " . $desc . "</p>";        
             foreach($domains as $domain) {
                 echo "<script>alert(\"entered domain loop\")</script>";
                 echo "INSERT INTO " . $charOrComp . "(DOMAIN_ID, NAME, DESCRIPTION) VALUES (" . $domain . ", " . $name . ", " . $desc . ");";
             $db->query("INSERT INTO " . $charOrComp . "(DOMAIN_ID, NAME, DESCRIPTION) VALUES ('" . $domain . "', '" . $name . "', '" . $desc . "');");
             }
         }
        //DELETE
        if($dbCmd == "Delete"){
            $table = filter_var($_GET["table"]);
            $id = filter_var($_GET["id"]);
            echo "<p>table = " . $table . "<br>id = " . $id . "</p>"; 
            echo "DELETE FROM " . $table . " WHERE ID = '" . $id. "';";
            $db->query("DELETE FROM " . $table . " WHERE ID = '" . $id. "';");
        }
        //EDIT
        if($dbCmd == "Edit"){
            $name = filter_var($_POST["name"]);
            $desc = filter_var($_POST["desc"]);
            $table = filter_var($_GET["table"]);
            $id = filter_var($_GET["id"]);
            echo "<p>table = " . $table . "<br>id = " . $id . "</p>"; 
            echo "UPDATE " . $table . " SET NAME = '" . $name. "', DESCRIPTION = '" . $desc . "' WHERE ID = '" . $id. "';";
            $db->query("UPDATE " . $table . " SET NAME = '" . $name. "', DESCRIPTION = '" . $desc . "' WHERE ID = '" . $id. "';");
        }
    }
//header("Location: 3DomainsHome.php");
?>
    </body>
</html>