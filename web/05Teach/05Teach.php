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
    
   // foreach ($db->query('SELECT BOOK FROM SCRIPTURES') as $row)
   // {
   //     echo '<strong>' . $row[1] . ' ' $row[2] . ':' . $row[3] . '</strong>' . ' - "' . $row[4] . '"';
   // }
    
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}
    
foreach ($db->query('SELECT * FROM SCRIPTURES') as $row)
  {
      echo '<strong>' . $row[1] . ' ' . $row[2] . ':' . $row[3] . '</strong>' . ' - "' . $row[4] . '"';
  }
?>
    
</body>
</html>