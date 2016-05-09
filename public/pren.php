<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "herz";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","root","","herz");
$userID = $_POST['userID'];
$channelID = $_POST['channelID'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {
$prenCheckQ = <<<END
SELECT * FROM subscribe
WHERE userID = '{$userID}'
AND channelID = '{$channelID}'
END;
$prenCheckG = $mysqli->query($prenCheckQ);
if($prenCheckG->num_rows > 0){
$sql = <<<END
DELETE FROM subscribe WHERE
channelID = '{$channelID}'
AND userID = '{$userID}'
END;
if (mysqli_query($conn, $sql)) {
		echo 'removed';
 }

}
else {
	$sql = "INSERT INTO subscribe (userID, channelID)
VALUES ('{$userID}', '{$channelID}')";
if (mysqli_query($conn, $sql)) {
		echo 'added';
 }
}

}
$conn->close();
?>