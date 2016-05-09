<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "herz";

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
	if($soundIDS == ''){
		$newValue = $soundIDS . $soundID;
	}
	else {
	$newValue = $soundIDS . ', ' . $soundID;
}
//query för att uppdatera
	$sql = <<<END
UPDATE playlists
SET soundIDs = '{$newValue}'
WHERE listID = '{$listID}'
END;
if (mysqli_query($conn, $sql)) {
	echo 'japp';
	}
	else {
		echo 'napp';
	}
}

}
$conn->close();
?>