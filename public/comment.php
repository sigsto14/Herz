<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "herz";
$response = array();
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","root","","herz");
$userID = $_POST['userID'];
$soundID = $_POST['soundID'];
$comment = $_POST['comment'];




if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {

echo 'COMMENT';

}
?>