@extends('template')
@section('container')
@section('footer')
<head>

</head>
 <?php
    $ADD = '';          /* ska ta fram existerande spellistor för användaren */
  $listID= $playlist->listID;
             $arr = array();
             $list = DB::table('playlists')->where('listID', '=', $listID)->first(); 
             $user = DB::table('users')->where('userID', '=', $playlist->userID)->first();
 $listItems = array_values(explode(',',$list->soundIDs,13));



foreach($listItems as $listItem){
$sounds = DB::table('sounds')->where('soundID', '=', $listItem)->get();

}
foreach($sounds as $sound){
$ADD .= $sound->URL;

}
$str ='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<music>
<song url="' . $ADD .'"/>
</music>';



echo $str;

$file_name="list.xml"; // file name
$fp = fopen ($file_name, "w"); 

fwrite ($fp,$str); 
fclose ($fp); 
chmod($file_name,0777); 

 ?>

<body>
  <div class="container">
    <div class="col-md-12" id="container">
    <h1>{{ $list->listTitle }}</h1>
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
<embed src="http://localhost/Herz/public/mp3_player/mp3_player.swf" style="width:600px;height:150px;">
</div>
</div>
</div>
</body>

@stop