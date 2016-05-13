@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>
  <div class="container">
  <div class="col-md-12" id="container4">

 @if(Auth::user())
<!-- gör lite php-kod för att hämta ut rätt info -->
<?php

$userID = Auth::user()->userID;
/* gör en variabel för att hämta ut alla favoriter användaren har **/
$subscribes = DB::table('subscribe')->where('subscribe.userID', '=', $userID)->join('channels', 'subscribe.channelID', '=', 'channels.channelID')->get();


?>

<body>
@yield('content')
<br>
   <h1 id="uc-title">{{ Auth::user()->username }}'s prenumerationer</h1>
   <!-- lägger ut resultaten en och en -->
   <div class="row">
    @foreach($subscribes as $subscribe)
    <!-- gör variabel inuti foreachen för att kunna hämta ut ur sounds-tabellen som stämmer överens, kollar om kanal har sound annars text att den saknar -->
<?php
$uploads = DB::table('subscribe')->join('sounds', 'sounds.channelID', '=', 'subscribe.channelID')->join('channels', 'channels.channelID', '=', 'sounds.channelID')->where('sounds.channelID','=',$subscribe->channelID)->orderBy('sounds.created_at', 'ASC')->take(1)->get();

$mysqli = new mysqli("localhost","root","","herz");
$channelID = $subscribe->channelID;
$query = <<<END
SELECT * FROM sounds
WHERE channelID = '{$channelID}'
END;

$res = $mysqli->query($query);
if($res->num_rows > 0){
  $state = 1;

}
else {

$state = 0;
}
?>

              <div class="col-md-3" id="uc-box">
              @if($state == 1)
@foreach($uploads as $upload)          
               <a href="http://localhost/Herz/public/sound/{{ $upload->podpicture }}"><image src="{{ $upload->podpicture }}" width="150px" height="150" id="pod-mini-img"></a>
               <div class="podtitle-box">
               <a href="http://localhost/Herz/public/sound/{{ $upload->soundID }}"><h4>{{ $upload->title }}</h4></a>
               <div class="podtitledownbox">
              <div class="podfavicon2">
                <div class="vertical-line2" style="margin-left:-60%; "></div>
                 <p style="margin-top: -3%; margin-left:-55%; font-size: 9px;">{{ $upload->created_at }}</p>
                </div>     
            <div class="podchanneltitle">              
              <p style="margin-left: 6%; margin-top: -3%; font-size: 10px;">av <a href="http://localhost/Herz/public/channel/{{ $upload->channelID }}" style="font-size: 10px;">{{ $upload->channelname }}</a></p>
              </div>
              </div>
              </div>
              </div>
                       @endforeach
         @else
<p>Denna kanal har inga ljudklipp än!</p>
@endif 
     @endforeach
      </div>
     </div>
     </div>
   

    @endif  

</div>
</div>
</div>
</body>
@stop