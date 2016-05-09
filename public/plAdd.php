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
echo 'hej';
}
$conn->close();
?>