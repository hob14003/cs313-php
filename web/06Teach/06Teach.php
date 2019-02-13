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
    
foreach ($db->query('SELECT * FROM SCRIPTURES') as $row)
  {
      echo '<strong>' . $row[1] . ' ' . $row[2] . ':' . $row[3] . '</strong>' . ' - "' . $row[4] . '"';
      echo '<br>';
  }

?>
    
<form action="06Teach.php" method="post">
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
foreach ($db->query('SELECT Name FROM Topic') as $row)
  {
        echo "<input type=\”checkbox\” name=\”topic\” value=\”" . $row[0] . "\”><br>”;";
  }
?>
   <input type="submit" value="Submit">
</form> 

    
</body>
</html>