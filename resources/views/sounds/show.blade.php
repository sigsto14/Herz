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
    <div class="channel_header">
      <div class="podbox">
          <div class="titlepod">
          <!-- gör variabel för att kunna se om det är den inloggade användarens klipp -->
          <?php
          $channel = DB::table('channels')->where('channelID', '=', $sound->channelID)->first();
          if(Auth::check()){
            $userID = Auth::user()->userID;
          }
          else {
            $userID = '';
         

          }
          /* variabel för att se om man subscribar */
          $sub = DB::table('subscribe')->where('userID', '=', $userID)->where('channelID', '=', $sound->channelID)->count();
          ?>
          @if($sound->status != 'privat' or $channel->channelID == $userID or $sub > 0)
            <h1>{{ $sound->title }}</h1>
            <p>Beskrivning:</p><p>{{ $sound->description }}</p>
          </div>
          <div class="pic">  
            <img src="{{ $sound->podpicture }}" style="width:145px;height:159px;"></div>
          <div class="spela">     
               <!--  <audio controls>
  <source src="{{ $sound->URL }}" type="audio/ogg">
  <source src="{{ $sound->URL }}" type="audio/mpeg">
Your browser does not support the audio element.
</audio> -->
  <div id="flashContent">
<embed src="http://localhost/Herz/public/mp3_player/mp3_player.swf" style="width:600px;height:150px;">
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
$favNr = DB::table('favorites')->where('soundID', '=', $sound->soundID)->count();
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
              <div class="podfavk">

{!! Form::close() !!}

@else
{!! Form::open(array('method' => 'DELETE', 'route' => array('favorite.destroy', $sound->soundID)))  !!}
<div class="podfavk2">
      <button name="submit" type="submit" class="btn btn-default btn-md" id="fav-knapp">
              <span class="glyphicon glyphicon-heart" aria-hidden="true"id="heart"></a><p> Ta bort favorit</p></span>
              </button>
{!! Form::close() !!}</td>
</div>
@endif
<!-- knapp för att anmäla klipp -->
 <button type="button" class="btn btn-default" id="report"><span class="glyphicon glyphicon-alert"></span></button> 
<div class="hidden" id="reportOpen">
 <form action="http://ideweb2.hh.se/~sigsto14/Test/report.php" method="post" id="report">
 {!! csrf_field() !!} 
<input type="text" name="msg" id="msg" placeholder="Varför vill du anmäla klippet?">
<input type="hidden" name="soundID" id="soundID" value="{{ $sound->soundID }}">
<input type="hidden" name="user" id="user" value="{{ Auth::user()->username }}">
 <button type="submit" class="btn btn-default">Anmäl</button>


</form> 
</div>

 <script>
$('#report').click(function(){
  $("#reportOpen").toggleClass("hidden");

});
</script>


<br><br><br><br><br>
<td>{!! Form::open(array('route' => 'playlist.update', 'method' => 'PUT')) !!}
<div>
        <input type="hidden" name="soundID" value="{{ $sound->soundID }}">
</div>

          
               <button type="button" class="btn btn-default btn-md" id="addList">
              <span class="glyphicon glyphicon-star" aria-hidden="true"></a><p> Lägg i spellista</p></span>
              </button>
              <div class="hidden" id="playlistEdit">
              <?php
              $lists = DB::table('playlists')->where('userID', '=', Auth::user()->userID)->get();
              ?>

              @if(!is_null($lists))
<!-- script för att ta fram lista spellistor -->
 <script>
$('#addList').click(function(){
  $("#playlistEdit").removeClass("hidden"); 

});
</script>
          <select name="listID">
         @foreach($lists as $list)
 <option value="{{$list->listID}}">{{ $list->listTitle }}</option>

@endforeach
</select>
<button type="submit">Lägg till!</button>

<button type="button"><a href="http://localhost/Herz/public/playlist"> Skapa ny spellista</a></button>
@elseif(is_null($lists))
<p> du har inga spellistor, skapa spellistor på <a href="http://localhost/public/user/{{ Auth::user()->userID }}">Din profil</a></p>

@endif
</div>


{!! Form::close() !!}

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
<td><p>Favorit:</p></td>
</tr>
<tr>
<td><a href="http://localhost/Herz/public/channel/{{ $channel->channelID }}" id="pbi">{{ $channel->channelname }}</a></td>
<td><p><span class="glyphicon glyphicon-heart">{{ $favNr }}</span></p></td>
</tr>
</table>
</div>

<div class="komment">
<!-- Kommentarer -->
<h3>Kommentarer:</h3>    

@foreach($comments as $comment)
<img src="{{$comment->profilePicture}}" style="width:90px; height: 90px;"><br>
<a href="http://localhost/Herz/public/user/{{ $comment->userID}}">{{$comment->username}}</a><br>
{{$comment->comment}}
@endforeach
<br><br><br><br><br><br>
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
<!-- om det är privat klipp -->
  @else
 
<h3>Du har ej behörighet att se detta ljudklipp :( </h3>
<p>Kanal <a href="http://localhost/Herz/public/channel/{{ $sound->channelID }}">{{ $channel->channelname }}</a> har gjort detta klipp otillgängligt för icke -prenumeranter</p>
@endif
        </div>

        </div>
        </div>
        </div>
        </div>



</body>
@stop