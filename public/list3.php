<?php


$mysqli = new mysqli("localhost","root","","herz");

$ADD = '';

$str ='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<music>';

$listID = $_GET['listID3'];
$userID = $_GET['userID3'];

$query = <<<END
SELECT * FROM playlists
WHERE listID = '{$listID}'


END;
$res = $mysqli->query($query);
if($res->num_rows > 0){
  $playlist = $res->fetch_object();

  $listItems = array_values(explode(',',$playlist->soundIDs,13));
  foreach($listItems as $listItem){

	$query2 = <<<END
	SELECT * FROM sounds
	WHERE soundID = '{$listItem}'
END;
$res2 = $mysqli->query($query2);
if($res2->num_rows > 0){
	
	$URLS = $res2->fetch_object(); 
}
if($URLS->URL == ''){

}
else{
	$ADD .= '<song url="' . $URLS->URL .'"/>
	';
}

}
}

$str .= $ADD;
$str .= '</music>';



echo $str;

$file_name="list.xml"; // file name
$fp = fopen ($file_name, "w"); 

fwrite ($fp,$str); 
fclose ($fp); 
chmod($file_name,0777); 

?>