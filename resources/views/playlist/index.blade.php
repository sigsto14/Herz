@extends('template')
@section('container')
@section('footer')

<body>
   <div class="container">
<div class="col-md-3"></div>
<div class="col-md-6" id="mini-container">

<h1>Spellista</h1>
    <!-- skapa lista/se mina listor om inloggad -->
    @if(Auth::check())
    <div class="section">Skapa Spelliss</div>
    <div class="inner-wrap">
<td>{!! Form::open(array('route' => 'playlist.store')) !!}
 {!! csrf_field() !!}
<div>
<!-- gömt formulär för användarID till controller -->
        <input type="hidden" name="userID" value="{{ Auth::user()->userID }}">
</div>
{!! Form::label('Spellisttitel:') !!}
{!! Form::text('listTitle') !!}<br>
{!! Form::label('Spellistbeskrivning:') !!}
{!! Form::text('listDescription') !!}<br>
<button name="submit" type="submit" class="btn btn-default btn-md">
              Lägg till spellista 
              </button>



</div>

{!! Form::close() !!}
<div class="section">Mina spellistor</div>
    <div class="inner-wrap">
<!-- redigering av befintliga spellistor -->
<table class="table">
<?php
/* hämtar ut spellistorna */
$user = Auth::user();
$playlists = DB::table('playlists')->where('userID', '=', $user->userID)->orderBy('created_at', 'DESC')->get();
$playlistsCheck = DB::table('playlists')->where('userID', '=', $user->userID)->first();


?>
<!-- kollar så den ej e tom -->
@if(!is_null($playlistsCheck))
<!-- presenterar spellistorna -->

<script>
$(document).ready(function() {
$('.editList').on( "click", function( event ) {

  $(this).next('.box1').toggleClass("hidden");

 

});
});
</script>
@foreach($playlists as $playlist)

<?php
/* hämtar ut items i dem */
$listItems = array_values(explode(',',$playlist->soundIDs,13));


?>
<a href="http://localhost/Herz/public/playlist/{{ $playlist->listID }}"><h4>{{ $playlist->listTitle }}</h4></a>

@if($playlist->soundIDs == '')
<p>Spellista tom</p>
<!-- inget formulär om det är tomt i spellistan -->
@else
<a id="editList" class="editList">
             Redigera spellista <span class="caret"></span>
              </button></a>
<!-- dessa formulär skall ej synas om ej i klickat -->
<!-- formulär för redigera titel och beskrivning -->
<div class="hidden box1" id="box1">
<form action="http://localhost/Herz/public/playlist/redigera" method="post" accept-charset="UTF-8">
 {!! csrf_field() !!}
Listtitel:<input type="text" name="listTitle" placeholder="{{ $playlist->listTitle }}" value="{{ $playlist->listTitle }}"><br>
Beskrivning:<input type="textarea" name="listDescription" placeholder="{{ $playlist->listDescription }}" value="{{ $playlist->listDescription }}">
<input type="hidden" name="listID" value="{{ $playlist->listID }}">
<button name="submit" type="submit" class="btn btn-default btn-md">
              Spara
              </button>
</form>

<!-- formulär för att ta bort klipp ur spellista -->
<h4> Ta bort klipp ur spellista </h4>
<form action="http://localhost/Herz/public/playlist/taBort" method="post" accept-charset="UTF-8">
 {!! csrf_field() !!}
 <input type="hidden" name="listID" value="{{ $playlist->listID }}">
<select name="soundID">
@foreach($listItems as $listItem)
<?php
$sounds = DB::table('sounds')->where('soundID', '=', $listItem)->get();
?>
@foreach($sounds as $sound)

<option value="{{ $sound->soundID}}">{{ $sound->title}}</option>


@endforeach
@endforeach
</select>
{!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort klippet ur spellistan?");' )) !!}
{!! Form::close() !!}
</div>
<!-- script för att öppna formulären -->

@endif
@endforeach
</table>


@endif
@endif

@if(Session::has('message'))
<div class="alert alert-success">
	{{ Session::get('message') }}
</div>
@endif
</div> 
</div>
</div>
</div>


</body>
@stop