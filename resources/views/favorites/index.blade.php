@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>
  <div class="container">
  <div class="col-md-12" id="container">

 @if(Auth::user())

<?php
$favorites1 = DB::table('favorites')->join('sounds', 'favorites.soundID', '=', 'sounds.soundID')->join('users', 'users.userID', '=', 'favorites.userID')->get();
$userID = Auth::user()->userID;
/* gör en variabel för att hämta ut alla favoriter användaren har **/
$favorites = DB::table('favorites')->where('favorites.userID', '=', $userID)->join('sounds', 'favorites.soundID', '=', 'sounds.soundID')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->get();
?>

<br><br><br><br><br><br>
<body>
@yield('content')

   <h1>{{ Auth::user()->username }}'s favoriter</h1>
   <!-- lägger ut resultaten en och en -->
    @foreach($favorites as $favorite)
   
<!--rad 1--><h1>{{ $favorite->title }}</h1>
<!-- rad 2--><image src="{{ $favorite->podpicture }}" width="100px" height="auto"></image><br>
<!--rad 3--><audio controls>
  <source src="{{ $favorite->URL }}" type="audio/ogg">
  <source src="{{ $favorite->URL }}" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
<!--rad 4 --><p>Från kanal: <a href="http://localhost/Herz/public/channel/{{ $favorite->channelID }}">{{ $favorite->channelname}}</a></p>
<!--rad 5-->{!! Form::open(array('method' => 'DELETE', 'route' => array('favorite.destroy', $favorite->soundID)))	!!}
			{!! Form::submit('Ta bort favorit', '', array('class' => 'form-control')) !!}
{!! Form::close() !!}

            @endforeach
    
        
         


    
        </div>
        </div>
     
   
		@endif	



</body>
@stop