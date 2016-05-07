
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "herz";
$content = '';
$counter = 0;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","root","","herz");
$userID = $_POST['userID'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {
//kommentarer hämtar från berörda saker
	$commentsQ = <<<END
SELECT sounds.soundID, sounds.title, sounds.channelID, users.username, comments.comment, comments.userID, channels.channelID FROM sounds 
JOIN comments
ON comments.soundID = sounds.soundID
JOIN users
ON users.userID = comments.userID
JOIN channels
ON channels.channelID = sounds.channelID
WHERE channels.channelID = '{$userID}'
ORDER BY comments.created_at DESC
END;

//kör query
$commentsG = $mysqli->query($commentsQ);
if($commentsG->num_rows >0){
	$comments = $commentsG->fetch_object();
	$comment = utf8_encode($comments->comment);
		$title = utf8_encode($comments->title);
$content = '<li><a href="http://localhost/Herz/public/user/' . $comments->userID . '">' . $comments->username . '</a> Har kommenterat: ' . $comment .' din pod: <a href="http://localhost/Herz/public/sound/' . $comments->soundID .'">'  . $title . '</a></li>';
//samma i while loop för att få fler resultat
while($comments = $commentsG->fetch_object()){
	$comment = utf8_encode($comments->comment);
		$title = utf8_encode($comments->title);
$counter++;
		if($counter < 5){
	$content .= '<li><a href="http://localhost/Herz/public/user/' . $comments->userID . '">' . $comments->username . '</a> Har kommenterat: ' . $comment .' din pod: <a href="http://localhost/Herz/public/sound/' . $comments->soundID .'">'  . $title . '</a></li>';
}
}


}

echo $content;
}
?>

