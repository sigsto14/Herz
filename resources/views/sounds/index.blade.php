@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<title>Users</title>

<body>
@yield('content')


<div class="container">
<div class="col-md-12" id="back"><br><br>
<p class="titles">Users:</p>
<table class="table">
<br><br><br><br>
<h2>Senaste uppladdningar</h2>
<th>Titel</th>
<th>Bild</th>
<th>Spelare</th>
<th>Kanal</th>
<th>Uppladdat av</th>

<!-- PHP för att hämta ut ljudklippen och kunna hämta vem som laddat upp och annan info -->
			<?PHP
     
              $sounds = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->join('users', 'sounds.channelID', '=', 'users.userID')->orderBy('sounds.created_at', 'desc')->get();
          ?>
		
			<!-- gör en foreach, så att vi drar ut var klipp och kör dess info enskilt i en tabell -->
			@foreach($sounds as $sound)
			<tr>	<td><a href="http://localhost/Herz/public/sound/{{ $sound->soundID }}"><h1>{{ $sound->title}}</h1>
			<td><image src="{{ $sound->podpicture }}" width="80px" height="auto">
			<td><audio controls>
  <source src="{{ $sound->URL }}" type="audio/ogg">
  <source src="{{ $sound->URL }}" type="audio/mpeg">
Your browser does not support the audio element.
</audio></td>
			<td><a href="http://localhost/Herz/public/channel/{{ $sound->channelID }}">{{ $sound->channelname }}</a></td>

		<td><a href="http://localhost/Herz/public/user/{{ $sound->channelID }}">{{ $sound->username }}</a></td>
				@endforeach
			
			
				
				</tr>
			
</table>

</div>			 
	





</div>


</body>
@stop