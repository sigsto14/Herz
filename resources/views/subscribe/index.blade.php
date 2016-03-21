@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>
  <div class="container">
  <div class="col-md-12" id="container">

 @if(Auth::user())
<!-- gör lite php-kod för att hämta ut rätt info -->
<?php

$userID = Auth::user()->userID;
/* gör en variabel för att hämta ut alla favoriter användaren har **/
$subscribes = DB::table('subscribe')->where('subscribe.userID', '=', $userID)->join('channels', 'subscribe.channelID', '=', 'channels.channelID')->get();


?>

<body>
@yield('content')

   <h2>{{ Auth::user()->username }}'s prenumerationer</h2>
   <!-- lägger ut resultaten en och en -->

    @foreach($subscribes as $subscribe)
    <!-- gör variabel inuti foreachen för att kunna hämta ut ur sounds-tabellen som stämmer överens, kollar om kanal har sound annars text att den saknar -->
<?php
$uploads = DB::table('subscribe')->join('sounds', 'sounds.channelID', '=', 'subscribe.channelID')->where('sounds.channelID','=',$subscribe->channelID)->orderBy('sounds.created_at', 'ASC')->take(1)->get();

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
              <div class="row">
              <div class="col-md-4">
                <a href="http://localhost/Herz/public/channel/{{ $subscribe->channelID }}"><h1>{{ $subscribe->channelname }}</h1></a>
              
@if($state == 1)
@foreach($uploads as $upload)

<p>Senaste uppladdning</p><br>
<p>{{ $upload->created_at }}</p>
<h3>{{ $upload->title }}</h3>
              <image src="{{ $upload->podpicture }}" width="100px" height="auto"></image><br>
              <audio controls>
              <source src="{{ $upload->URL }}" type="audio/ogg">
              <source src="{{ $upload->URL }}" type="audio/mpeg">
              Your browser does not support the audio element.
              </audio>


@endforeach
@else
<p>Denna kanal har inga ljudklipp än!</p>
@endif
              </div>           

  

         @endforeach
         


    
        </div>
        </div>
</div>
</div>        
     
   
		@endif	



</body>
@stop