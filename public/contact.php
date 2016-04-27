
<?php

if(isset($_POST))
{


$to = "sigsto14@student.hh.se";
$subject = utf8_decode("Herz kontaktform");
$msg = $_POST["msg"];
$headers = "From: " . $_POST["email"];
mail($to,$subject,$msg,$headers);
}
header("Location: http://localhost/Herz/public/");
?>
