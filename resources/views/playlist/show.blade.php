@extends('template')
@section('container')
@section('footer')
<head>

</head>
 <?php
$mysqli = new mysqli("localhost","root","","herz");


$ADD = '';
$PIC = '';
$str ='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<music>';
$picStr = '<?xml version="1.0" encoding="utf-8"?>
<GALLERY COLUMNS="1" XPOSITION="30" YPOSITION="30" WIDTH="150" HEIGHT="150">
';

$listID = $playlist->listID;
$user = DB::table('users')->where('userID', '=', $playlist->userID)->first();

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

if($URLS->URL == ''){

}
else{
    $channelID = $URLS->channelID;
  $channelGet = <<<END
SELECT * FROM channels
where channelID = '{$channelID}'
END;
$channelGet2 = $mysqli->query($channelGet);
$channel = $channelGet2->fetch_object();

  $ADD .= '<song url="' . $URLS->URL .'">
  <songTitle>' . $URLS->title . '</songTitle>
    <songArtist>' . $channel->channelname . '</songArtist>
  </song>
  ';

}
if($URLS->podpicture == ''){

}
else{
  $PIC .= '<IMAGE THUMB="' . $URLS->podpicture .'"/>
  ';
}
}
else {
  $URLS = '';
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

<body>
  <div class="container">
    <div class="col-md-12" id="container">
    <h1>{{ $playlist->listTitle }}</h1>
    <p>av <a href="http://localhost/Herz/public/user/{{ $user->userID }}">{{ $user->username}}</a></p>
@foreach($listItems as $listItem)

<?php

$sounds = DB::table('sounds')->where('soundID', '=', $listItem)->get();
?>

    @foreach($sounds as $sound)
              <li><a href="http://localhost/Herz/public/sound/{{ $sound->soundID }}">{{ $sound->title }}</a></li>
              @endforeach
            
@endforeach

  <div id="flashContent">
<embed src="http://localhost/Herz/public/playlistPlayer/mp3_player.swf" style="width:600px;height:350px;">
</div>
</div>
</div>
</body>

@stop