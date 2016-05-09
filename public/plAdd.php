<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "herz";
$content = '';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","root","","herz");
$soundID = $_POST['soundID'];
$listID = $_POST['listID'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {

 	$playlistQ = <<<END
SELECT * FROM playlists
WHERE listID = '{$listID}'
END;

// kör queryn 
$playlistG = $mysqli->query($playlistQ);
//kollar om finns res
if($playlistG->num_rows > 0){
	//om finns res
	//hämtar object
	$playlist = $playlistG->fetch_object();
	//vi behöver specifikt soundIDS, hämtar ut.
	$soundIDS = $playlist->soundIDs;
$listname = $playlist->listTitle;
	if($soundIDS == ''){
		$newValue = $soundIDS . $soundID;
	}
	else {
	$newValue = $soundIDS . ', ' . $soundID;
}

//query för att hämta ljud
$soundQ = <<<END
SELECT * FROM sounds
WHERE soundID = '{$soundID}'
END;
$soundG = $mysqli->query($soundQ);
if($soundG->num_rows >0){
	$sound = $soundG->fetch_object();
	$content = '<div class="alert gray"><button type="button" id="close" tooltip="OK" class="knp"><span class="glyphicon glyphicon-ok"></span></button>Pod ' .$sound->title.' tillagd i <a href="http://localhost/Herz/public/playlist/'. $listID .'" ><span id="plLink">' .$listname . '</span></a></div>';
}

//query för att uppdatera
	$sql = <<<END
UPDATE playlists
SET soundIDs = '{$newValue}'
WHERE listID = '{$listID}'
END;
if (mysqli_query($conn, $sql)) {
	echo $content;
	}
	else {
		echo 'napp';
	}
}

}
$conn->close();
?>