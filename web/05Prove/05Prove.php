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
    
foreach ($db->query('SELECT c.NAME AS Compnent, c.DESCRIPTION FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID WHERE d.ID = 1;') as $row)
  {
      echo '<strong>' . $row[0] . ' ' . $row[1];
      echo '<br>';
  }
    echo '<br>';
foreach ($db->query('SELECT c.NAME AS Compnent, c.DESCRIPTION FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID WHERE d.ID = 2;') as $row)
  {
      echo '<strong>' . $row[0] . ' ' . $row[1];
      echo '<br>';
  }
    echo '<br>';
foreach ($db->query('SELECT c.NAME AS Compnent, c.DESCRIPTION FROM DOMAIN d INNER JOIN COMPONENT c ON d.ID = c.DOMAIN_ID WHERE d.ID = 3;') as $row)
  {
      echo '<strong>' . $row[0] . ' ' . $row[1];
      echo '<br>';
  }
?>
    
</body>
</html>