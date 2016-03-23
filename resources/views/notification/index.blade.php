@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<title>Users</title>

<body>

@yield('content')


<div class="container" id="container">
<div class="col-md-12" id="back"><br><br>

<table class="table">
<br><br><br><br>

<!-- PHP för att hämta ut ljudklippen från de auth user subscribar på som laddats upp efter senaste inloggning -->
<?php
$userID = Auth::user()->userID;
        $LastLogout = Auth::user()->last_logout;

        /* om ny reg värdet från created_at istället */
  if(is_null($LastLogout)){

    $LastLogout = Auth::user()->created_at;
  }
  $subscribeNotes = DB::table('subscribe')->join('channels', 'channels.channelID', '=', 'subscribe.channelID')->join('sounds', 'sounds.channelID', '=', 'channels.channelID')->where('subscribe.userID', '=', $userID)->where('sounds.created_at', '>=', $LastLogout)
       ->orderBy('sounds.created_at', 'DESC')->take(5)->get();


?>
	
			<!-- gör en foreach, så att vi drar ut var klipp och kör dess info enskilt i en tabell -->
@yield('notis')
         @foreach($subscribeNotes as $subscribe)

 <a href="http://localhost/Herz/public/channel/{{ $subscribe->channelID }}"><h1>{{ $subscribe->title }}</h1></a>
<p>{{ $subscribe->created_at }}</p>
<h3>{{ $subscribe->title }}</h3>
              <image src="{{ $subscribe->podpicture }}" width="100px" height="auto"></image><br>
              <audio controls>
              <source src="{{ $subscribe->URL }}" type="audio/ogg">
              <source src="{{ $subscribe->URL }}" type="audio/mpeg">
              Your browser does not support the audio element.
              </audio>

@endforeach
@show
			
</table>

</div>			 
	





</div>


</body>
@stop