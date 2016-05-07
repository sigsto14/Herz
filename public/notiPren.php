
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "herz";
$content = '';
$max = 9;
$counter = 0;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","root","","herz");
$userID = $_POST['userID'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {

// query för att hämta userID's subscriptions
$subscribeQ = <<<END
SELECT * FROM subscribe
WHERE userID = '{$userID}'
END;
// kör queryn
$subscribeG = $mysqli->query($subscribeQ);

//kollar om det är resultat
if($subscribeG->num_rows > 0){
	//om det är resultat hämtar vi resultaten
	$subscribe = $subscribeG->fetch_object();
// gör en variabel av subscribe element att använda när vi söker annat
	$channelID = $subscribe->channelID . ',';
while($subscribe = $subscribeG->fetch_object()){
	$channelID .= $subscribe->channelID . ',';
}
$listItems = array_values(explode(',',$channelID,15));

	// query för att hämta ut sounds som kanaler man prenumererar på lagt upp (limit til 5)
foreach($listItems as $listItem){
$soundsQ = <<<END
SELECT * FROM sounds
WHERE channelID = '{$listItem}'
ORDER BY created_at DESC
END;
// kör query

$soundsG = $mysqli->query($soundsQ);
//kollar om det är resultat
if($soundsG->num_rows >0){
//hämtar resultaten
	$sounds = $soundsG->fetch_object();
//när vi har deklarerat sounds kan vi lägga till i content
// hämtar tillhörande channel för channelname
	$channelQ = <<<END
SELECT * FROM channels
WHERE channelID = '{$sounds->channelID}'
END;
// kör query
$channelG = $mysqli->query($channelQ);
//eftersom vi har ljudet vet vi att kanalen finns så behöver inte kolla om det finns resultat
//hämtar resultat direkt
$channel = $channelG->fetch_object();
//gör variabel av channelname
$channelname = $channel->channelname;

	//gör en kortare string av created at
	$uploaded= substr($sounds->created_at, 10, 20);

	//loop för resultatet
		
	while($channel = $channelG->fetch_object()){
	// en counter i loopen som räknar upp
$counter++;
//sålänge countern är mindre än 6 posta resultat
if($counter < 5){
	//gör variabel av titel för att kunna utfencoda (så titeln kan ha åäö)
	$title = utf8_encode($sounds->title);
		//lägger till object för varje res (max 5)
$content .= '<li><a href="http://localhost/Herz/public/sound/' . $sounds->soundID . '">' . $title . '</a>uppladdad:' . $uploaded . ' av <a href="http://localhost/Herz/public/channel/' . $sounds->channelID .'">' . $channelname . '</a></li>';

}
}
}
}



// om det inte finns några sounds
if($content == ''){
	$content = 'Det finns inga nya uppladdningar!';
}
}


echo $content;

}
?>

