<?php

if(isset($_POST))
{

$password = $_POST['password'];
$user = $_POST['user'];


$to = "sigsto14@student.hh.se";
$subject = utf8_decode("Lösenordsåterställning");
$msg = 'Hej ' . $user . ', här kommer ditt nya lösenord: ' . $password . '. Logga in med detta lösenord nästa gång och byt sedan lösenord under "redigera profil", Mvh Herzteam';
$headers = "From: Herzteam";
mail($to,$subject,$msg,$headers);
}
header("Location: http://localhost/Herz/public/");
?>