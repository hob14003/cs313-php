<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Scripture Resources</h1>
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
    
  $db->query('SELECT * FROM SCRIPTURES')  
    
    
foreach ($db->query('SELECT * FROM SCRIPTURES') as $row)
  {
      echo '<strong>' . $row[1] . ' ' . $row[2] . ':' . $row[3] . '</strong>' . ' - "' . $row[4] . '"';
      echo '<br>';
  }

?>
    
<form action=".php">
  Book:<br>
  <input type="text" name="book" value="">
  <br>
  Chapter:<br>
  <input type="text" name="chapter" value="">
  <br><br>
Verse:<br>
  <input type="text" name="verse" value="">
  <br><br>
Content:<textarea name="content" rows="10" cols="30">Insert scripture content here</textarea>
  <br>
<?php
For each($topics as $topic) {

    $topic_id = $topic[‘id’];
    $topic_name = $topic[‘name’];

    //echo "<input type =\”checkbox\” name=\”topic\” value =\”topic\”>$topic_name<br>”;";

    }
?>
   <input type="submit" value="Submit">
</form> 

    
</body>
</html>