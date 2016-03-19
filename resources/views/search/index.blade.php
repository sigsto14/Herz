@extends('template')
@section('container')


<!DOCTYPE HTML>

<title>Sökresultat</title>
<div class="container" id="container">
<!-- kollar om sökningen hittat något -->
@if (count($channels) === 0)
Inga sökresultat
Kolla igenom <a href="http://localhost/Herz/public/sound">senaste uppladdningar!</a>
@elseif (count($channels) >= 1)
Sökresultat
<!-- om resultat lägger ut alla resultat -->
<table>
    @foreach($channels as $channel)



    <a href="http://localhost/Herz/public/sound/{{ $channel->soundID }}"><h1>{{ $channel->title}}</h1></a>
    <image src="{{ $channel->podpicture }}" width="80px" height="auto"></image>
    <audio controls>
  <source src="{{ $channel->URL }}" type="audio/ogg">
  <source src="{{ $channel->URL }}" type="audio/mpeg">
Your browser does not support the audio element.
</audio><br>
<!-- gör en liten variabel för att få ut categoryname -->

<p><a href="http://localhost/Herz/public/category/{{ $channel->categoryID }}">{{ $channel->categoryname }}</a></p>
UPPLADDAT AV <a href="http://localhost/Herz/public/channel/{{ $channel->channelID }}">{{ $channel->channelname }}</a>
    @endforeach
    </div>
    </div>

@endif

</table>
@section('footer')
@stop