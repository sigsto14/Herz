@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>

<title>{{ $sound->title }}</title>
<br><br><br><br><br><br>
<body>
@yield('content')
<!-- Kanal innehåll --> 
    <div class="container">
    <!-- Kanal header --> 
            <h1>{{ $sound->title }}</h1>
            <img src="{{ $sound->podpicture }}" style="width:145px;height:159px;"/>    
                 <audio controls>
  <source src="{{ $sound->URL }}" type="audio/ogg">
  <source src="{{ $sound->URL }}" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
<?php
$id = $sound->channelID;
$channel = DB::table('channels')->where('channels.channelID', '=', $id)->first();
$user = DB::table('users')->where('users.userID', '=', $id)->first();
?>
<h2>Tillhör kanal:</h2>
<a href="http://localhost/Herz/public/channel/{{ $channel->channelID }}">{{ $channel->channelname }}</a><br>
<p>Användare:</p>
<a href="http://localhost/Herz/public/user/{{ $channel->channelID }}">{{ $user->username }}</a>
</div>
    
        
          @if(Auth::user())

@endif
          </div>
        </div>
         <!-- Andra lådan, här fins podar -->
   
			



</body>
@stop