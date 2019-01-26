<!DOCTYPE html>
<html lang="en">
<body>
<?php
$name = $_POST["name"];
$email = $_POST["email"];
$major = $_POST["major"];
$comments = $_POST["comments"];
$continents = $_POST["continent"];
    
    
?>
    <?php echo "Your name is " + $name; ?>
    
    <p>Your name is <?php echo $name; ?></p>
    <p>Your email address is <?php echo "<a href=\"mailto:$email\"> $email </a>"; ?></p>
    <p>Your major is <?php echo $major; ?></p>
    <p>Comments: <?php echo $comments; ?></p>
    
    <?php  
foreach ($continents as $continent) {
    echo "$continent <br>";
    //idFunction($continent);
}
?>
    
</body>
</html>