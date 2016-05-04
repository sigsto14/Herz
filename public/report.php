<?php

if(isset($_POST))
{

$sound = $_POST['soundID'];
$user = $_POST['user'];
$message = $_POST['msg'];

}
if($message != ''){

$to = "sigsto14@student.hh.se";
$subject = utf8_decode("Anmälan olämpligt innehåll");
$msg = 'Användare: ' . $user . 'anmäler klipp' . $sound . ' med motiveringen ' . $message .'';
$headers = 'From:' . $user . '';
mail($to,$subject,$msg,$headers);

}

  	header("Location: http://localhost/Herz/public/report")


?>