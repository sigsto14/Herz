@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>
<?php

/* genererar en xml fil för att skicka till flashspelaren */

$sql= $sound;
$URL = $sound->URL;
$pic = $sound->podpicture;
echo $URL;
$str ='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<music>
<song url="' . $URL .'"/>

</music>';


$picStr = '<?xml version="1.0" encoding="utf-8"?>
<GALLERY COLUMNS="1" XPOSITION="30" YPOSITION="30" WIDTH="150" HEIGHT="150">
<IMAGE THUMB="' . $pic . '" />
</GALLERY>';
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

<title>{{ $sound->title }}</title>
<body>
@yield('content')
<!-- Kanal innehåll --> 
  <div class="container">
    <div class="col-md-12" id="container">
      <div class="podspelare">
        <div id="flashContent">
          <embed src="http://localhost/Herz/public/mp3_player/mp3_player.swf" style="width:600px;height:150px;">
        </div>
      </div>
      <div class="podmenu">
      </div>
      <div class="podinfo">
      </div>
      <div class="addkomment">
      </div>
      <div class="kommentarer">
      </div>
    </div>
  </div> 
</body>
@stop