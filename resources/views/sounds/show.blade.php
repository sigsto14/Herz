@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>
<?php

/* genererar en xml fil för att skicka till flashspelaren */

$sql= $sound;
$URL = $sound->URL;
echo $URL;
$str ='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<music>
<song url="' . $URL .'"/>
</music>';



echo $str;

$file_name="list.xml"; // file name
$fp = fopen ($file_name, "w"); 

fwrite ($fp,$str); 
fclose ($fp); 
chmod($file_name,0777); 


?>
<title>{{ $sound->title }}</title>
<body>
@yield('content')
<!-- Kanal innehåll --> 
    <div class="container">
    <div class="col-md-12" id="container">
    <div class="channel_header">
      <div class="podbox">
          <div class="titlepod">
            <h1>{{ $sound->title }}</h1>
            <p>Beskrivning:</p><p>{{ $sound->description }}</p>
          </div>
          <div class="pic">  
            <img src="{{ $sound->podpicture }}" style="width:145px;height:159px;"></div>
          <div class="spela">     
                 <audio controls>
  <source src="{{ $sound->URL }}" type="audio/ogg">
  <source src="{{ $sound->URL }}" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
  <div id="flashContent">
<embed src="http://localhost/Herz/public/mp3_player/mp3_player.swf">
</div>
@if(Auth::check())
<!-- php-kod för att kolla om det redan är favorit. Det fungerar ej med eloquent så vanlig sql/php löser problemet -->
<?php
$userID = Auth::user()->userID;
$soundID = $sound->soundID;

$mysqli = new mysqli("localhost","root","","herz");

$query = <<<END
SELECT * FROM favorites
WHERE userID = '{$userID}'
AND soundID = '{$soundID}'
END;

$res = $mysqli->query($query);
if($res->num_rows > 0){
  $state = 1;

}
else {

$state = 0;
}

?>
@if($state == 0)

<td>{!! Form::open(array('route' => 'favorite.store')) !!}
 {!! csrf_field() !!}
<div>
        <input type="hidden" name="userID" value="{{ Auth::user()->userID }}">
</div>
<div>
        <input type="hidden" name="soundID" value="{{ $sound->soundID }}">
</div>
</div> 
</div>
<div class="podfavk">
<button name="submit" type="submit" class="btn btn-default btn-md" id="fav-knapp">
              <span class=" glyphicon glyphicon-heart-empty" aria-hidden="true"  id="heart"></a><p> Lägg till favorit </p></span>
              </button></div>
{!! Form::close() !!}
@else
{!! Form::open(array('method' => 'DELETE', 'route' => array('favorite.destroy', $sound->soundID)))  !!}
<div class="podfavk2">
      <button name="submit" type="submit" class="btn btn-default btn-md" id="fav-knapp">
              <span class="glyphicon glyphicon-heart" aria-hidden="true"id="heart"></a><p> Ta bort favorit</p></span>
              </button>
{!! Form::close() !!}</td>

@endif
@endif
</div>
<?php
$id = $sound->channelID;
$channel = DB::table('channels')->where('channels.channelID', '=', $id)->first();
$user = DB::table('users')->where('users.userID', '=', $id)->first();
$comments = DB::table('comments')->join('users', 'users.userID', '=', 'comments.userID')->where('soundID', '=', $sound->soundID)->get();
?>
<div class="podbox2">
<br>
<table style="width:25%">
<tr>
<td><p>Tillhör kanal:</p></td>
<td><p>Användare:</p></td>
</tr>
<tr>
<td><a href="http://localhost/Herz/public/channel/{{ $channel->channelID }}" id="pbi">{{ $channel->channelname }}</a></td>
<td><a href="http://localhost/Herz/public/user/{{ $channel->channelID }}" id="pbi">{{ $user->username }}</a></td>
</tr>
</table>
</div>

<div class="komment">
<!-- Kommentarer -->
<h3>Kommentarer:</h3>    

@foreach($comments as $comment)
{{$comment->username}}<br>
{{$comment->comment}}
@endforeach

<!-- Kommentarsfält -->


  @if(Auth::user()) <!-- Ser om användaren är inloggad -->

    {!! Form::open(array('route' => 'comment.store', 'files' => 'true')) !!}
    {!! csrf_field() !!}
        <input type="hidden" name="userID" value="{{ Auth::user()->userID }}"><!-- Dolt fält som hämtar Användarid -->
        <input type="hidden" name="soundID" value="{{ $sound->soundID }}"><!-- Dolt fält som hämtar ljudid -->
    {!! Form::label('Kommentar:') !!}
    {!! Form::textarea('comment') !!}<br>

    {!! Form::submit('Lägg till kommentar', '', array('class' => 'form-control')) !!}
  {!! Form::close() !!}

</div>
<!-- Kommentarsfält slut-->

@endif

        </div>
  
 
        </div>
        </div>
        



</body>
@stop