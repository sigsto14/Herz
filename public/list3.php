<?php


$mysqli = new mysqli("localhost","root","","herz");

$ADD = '';
$PICADD = '';
$str ='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<music>';
$picStr = '<?xml version="1.0" encoding="utf-8"?>
<GALLERY COLUMNS="1" XPOSITION="30" YPOSITION="30" WIDTH="150" HEIGHT="150">
';

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
if($URLS->podpicture == ''){

}
else{
	$PIC .= '<IMAGE THUMB="' . $URLS->podpicture .'"/>
	';
}

}
}


$str .= $ADD;
$str .= '</music>';
$picStr .= $PIC;
$picStr .='</GALLERY>';


echo $str;

$file_name="list.xml"; // file name
$fp = fopen ($file_name, "w"); 

fwrite ($fp,$str); 
fclose ($fp); 
chmod($file_name,0777); 

$file_name2="gallery.xml"; // file name
$fp2 = fopen ($file_name2, "w"); 

fwrite ($fp2,$picStr); 
fclose ($fp2); 
chmod($file_name2,0777); 


?>