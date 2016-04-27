<?php

if(isset($_POST))
{

	$content = <<<END
	<h3>Ditt meddelande har skickats</h3>
	Från: {$_POST["name"]}
	<br>
	Meddelande: {$_POST["msg"]}
END;

$to = "sigsto14@student.hh.se";
$subject = utf8_decode("Herz kontaktform");
$msg = $_POST["msg"];
$headers = "From: " . $_POST["name"]
mail($to,$subject,$msg,$headers);
}
header("Location: http://localhost/Herz/public/");
?>