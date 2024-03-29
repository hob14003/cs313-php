<?php
$book = $_POST['book'];
$chapter = $_POST['chapter'];
$verse = $_POST['verse'];
$content = $_POST['content'];
$topicIds = $_POST['topic'];

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

try
{
	$query = 'INSERT INTO scriptures(book, chapter, verse, content) VALUES(:book, :chapter, :verse, :content)';
	$statement = $db->prepare($query);
	
	$statement->bindValue(':book', $book);
	$statement->bindValue(':chapter', $chapter);
	$statement->bindValue(':verse', $verse);
	$statement->bindValue(':content', $content);
	$statement->execute();
	
	//$scriptureId = $db->lastInsertId("scripture_id_seq");
	
   // $lastScripId = $db->prepare('SELECT ID FROM scriptures where Chapter = ' . $chapter . ' AND verse = ' . $verse . ' AND book = ' . );
    $scriptureId = $db->prepare('SELECT MAX(ID) FROM SCRIPTURES');
    
	foreach ($topicIds as $topicId)
	{
		echo "ScriptureId: $scriptureId, topicId: $topicId";
		
		$statement = $db->prepare('INSERT INTO m2m(topic_Id, scriptures_Id) VALUES(:topicId, :scriptureId)');
		
		$statement->bindValue(':scriptureId', $scripturesId);
		$statement->bindValue(':topicId', $topicId);
		$statement->execute();
	}
}
catch (Exception $ex)
{
	echo "Error with DB. Details: $ex";
	die();
}

header("Location: showTopics.php");
die(); 

?>
