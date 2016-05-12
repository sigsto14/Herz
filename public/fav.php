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
$soundID = $_POST['soundID'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {
$favCheckQ = <<<END
SELECT * FROM favorites
WHERE userID = '{$userID}'
AND soundID = '{$soundID}'
END;
$favCheckG = $mysqli->query($favCheckQ);
if($favCheckG->num_rows > 0){ 
$sql = <<<END
DELETE FROM favorites WHERE
soundID = '{$soundID}'
AND userID = '{$userID}'
END;
if (mysqli_query($conn, $sql)) {
	echo 'removed';
}


}
else {
	$sql = "INSERT INTO favorites (userID, soundID)
VALUES ('{$userID}', '{$soundID}')";
if (mysqli_query($conn, $sql)) {
	
$favNrQ = <<<END
SELECT * FROM favorites
WHERE soundID = '{$soundID}'
END;

$favNrG = $mysqli->query($favNrQ);
if($favNrG->num_rows > 0){
	$favNrG2 = $favNrG->fetch_object();
$favNr = mysqli_num_rows($favNrG);
		echo '<input type="hidden" id="favNrG" value="'. $favNr . '">
                <td><p><span class="glyphicon glyphicon-heart" style="color: #26a09f; margin-top: 6px; margin-left: 18%;">' . $favNr . '</span></p></td>';

}
 }
}


}
$conn->close();
?>