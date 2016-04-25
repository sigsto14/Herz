<?php

if(isset($_POST))
{

$sound = $_POST['soundID'];
$user = $_POST['user'];
$message = $_POST['msg'];

$to = "sigsto14@student.hh.se";
$subject = utf8_decode("Anmälan olämpligt innehåll");
$msg = $user . ' anmäler ljud med id: ' . $sound . ' med motiveringen "' . $message . '"';
$headers = "From: {$user}";
mail($to,$subject,$msg,$headers);
}
header("Location: http://localhost/Herz/public/report");
?>