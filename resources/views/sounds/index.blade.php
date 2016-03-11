@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<title>Users</title>

<body>

@yield('content')


<div class="container">
<div class="col-md-12" id="back"><br><br>

<table class="table">
<br><br><br><br>
<h2>Senaste uppladdningar</h2>
<th>Titel</th>
<th>Bild</th>
<th>Spelare</th>
<th>Kanal</th>
<th>Uppladdat av</th>
@if(Auth::check())
<th>Skapa favorit</th>
@endif
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
<!-- ett formulär för att lägga till favorit, med hidden fields för att det ska vara att bara trycka på en knapp (om state 0 alltså att den inte redan är favorit) -->
@if($state == 0)

<td>{!! Form::open(array('route' => 'favorite.store')) !!}
 {!! csrf_field() !!}
<div>
        <input type="hidden" name="userID" value="{{ Auth::user()->userID }}">
</div>
<div>
        <input type="hidden" name="soundID" value="{{ $sound->soundID }}">
</div>
 


<button name="submit" type="submit" class="btn btn-default btn-md" id="fav-knapp">
              <span class="glyphicon glyphicon-heart-empty" aria-hidden="true" id="heart"><p>Lägg till Favorit</p></span>
              </button>
{!! Form::close() !!}
@else
<td>{!! Form::open(array('method' => 'DELETE', 'route' => array('favorite.destroy', $sound->soundID)))	!!}
			<button name="submit" type="submit" class="btn btn-default btn-md" id="fav-knapp">
              <span class="glyphicon glyphicon-heart" aria-hidden="true" id="heart"><p>Tabort från favorit</p></span>
              </button>
{!! Form::close() !!}</td>


@endif



@endif
<!-- formuläret syns bra om man är inloggad -->

				@endforeach
			
			
				
				</tr>
			
</table>

</div>			 
	





</div>


</body>
@stop