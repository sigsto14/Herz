@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<title>Users</title>

<body>

@yield('content')


<div class="container">
<div class="col-md-12" id="container">
<table class="table">
<h3>Senaste uppladdningar</h3>
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
   
              
              
             
$user = Auth::user();
             
 
	
		$sounds = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->join('users', 'sounds.channelID', '=', 'users.userID')->orderBy('sounds.created_at', 'desc')->get();

		?>
	
			<!-- gör en foreach, så att vi drar ut var klipp och kör dess info enskilt i en tabell -->
			@foreach($sounds as $sound)

			<tr>	<td><a href="http://localhost/Herz/public/sound/{{ $sound->soundID }}"><h3>{{ $sound->title}}</h3>
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
@if($sound->channelID == $userID)
<td><button class="btn btn-default btn-md" id="star-knapp">
              <span class="glyphicon glyphicon-star" aria-hidden="true" id="heart"><p id="star">Ditt klipp</p></span>
              </button></td>
              @else
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
 


<button tooltip="Lägg till favorit" class="knp knp-7 knp-7e knp-icon-only icon-heart">Like</button>
{!! Form::close() !!}
@else
<td>{!! Form::open(array('method' => 'DELETE', 'route' => array('favorite.destroy', $sound->soundID)))	!!}

		
              <button tooltip="Ta bort favorit" class="knp knp-7 knp-7e knp-icon-only icon-heart-2">Like</button>
             
{!! Form::close() !!}</td>


@endif


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