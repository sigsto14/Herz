
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "herz";
$content = '';
$soundIDs = '';
$favSID = '';
$favoriteUserID = '';
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
// gör med hjälp av userID en query som selectar från multipla tabeller med userID som common value
$matchesQ = <<<END
SELECT sounds.soundID, sounds.title, favorites.userID FROM sounds
JOIN favorites
ON favorites.soundID = sounds.soundID
WHERE channelID = '{$userID}'
ORDER BY favorites.created_at DESC
END;
// kör queryn
$matchesG = $mysqli->query($matchesQ);
// kollar om det finns resultat
if($matchesG->num_rows > 0){
	//hämtar resultat
$matches = $matchesG->fetch_object();

//hämtar med matches-userID ut användarnamn

$favUserQ = <<<END
SELECT username FROM users
WHERE userID = '{$matches->userID}'
END;
$favUserG = $mysqli->query($favUserQ);
$favUser = $favUserG->fetch_object();
//encodar variabler
$favUsername = utf8_encode($favUser->username);
$title = utf8_encode($matches->title);
//läger till i content
	$content = '<li><a href="http://localhost/Herz/public/user/' . $matches->userID . '">' . $favUsername . '</a>gillar din pod: <a href="http://localhost/Herz/public/sound/' . $matches->soundID .'">'  . $title . '</a></li>';
//samma i while loop för att få fler resultat
while($matches= $matchesG->fetch_object()){
	$favUserQ = <<<END
SELECT username FROM users
WHERE userID = '{$matches->userID}'
END;
$favUserG = $mysqli->query($favUserQ);
$favUser = $favUserG->fetch_object();
$favUsername = utf8_encode($favUser->username);
// en counter som räknar upp i loopen för att kunna capa hur mycket vi matar ut
	$counter++;
	//använder counterns värde och matar bara ut när det är färre än max-värdet (5)
	if($counter < 5){
	$title = utf8_encode($matches->title);
	$content .= '<li><a href="http://localhost/Herz/public/user/' . $matches->userID . '">' . $favUsername . '</a>gillar din pod: <a href="http://localhost/Herz/public/sound/' . $matches->soundID .'">'  . $title . '</a></li>';
}
}

}

echo $content;
}


?>

