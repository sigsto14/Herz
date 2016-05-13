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
    <div class="section">Skapa Spellist</div>
    <div class="inner-wrap">
<td>{!! Form::open(array('route' => 'playlist.store')) !!}
 {!! csrf_field() !!}
<div>
<!-- gömt formulär för användarID till controller -->
        <input type="hidden" name="userID" value="{{ Auth::user()->userID }}">
</div>

<!-- Namn på spellista -->
<div>
    <label>Spellisttitel:</label>
    <input type="text" name="listTitle" data-toggle="tooltip" title="Skriv ett namn på din spellista">
</div>
<!-- Beskrivning av spellista -->
<div>
    <label>Spellistbeskrivning:</label>
    <textarea name="listDescription" rows="5" data-toggle="tooltip" title="Här kan du lägga till en beskrivning av din spellista"></textarea>
</div>

<button name="submit" type="submit" class="btn btn-default btn-md">
              Lägg till spellista 
</button>



</div>

{!! Form::close() !!}
<div class="section">Mina spellistor</div>
    <div class="inner-wrap">
<!-- redigering av befintliga spellistor -->
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
<div class="spellistbox">
<a href="http://localhost/Herz/public/playlist/{{ $playlist->listID }}"><h4>{{ $playlist->listTitle }}</h4></a>

@if($playlist->soundIDs == '')
<p>Spellista tom</p>
<!-- inget formulär om det är tomt i spellistan -->
</div><br>
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
<h5> Ta bort klipp ur spellista </h5>

<form action="http://localhost/Herz/public/playlist/taBort" method="post" accept-charset="UTF-8">
 {!! csrf_field() !!}
 <input  type="hidden" name="listID" value="{{ $playlist->listID }}">
  <div class="slist"> 
  <label>
<select  name="soundID">
@foreach($listItems as $listItem)
<?php
$sounds = DB::table('sounds')->where('soundID', '=', $listItem)->get();
?>
@foreach($sounds as $sound)

<option value="{{ $sound->soundID}}">{{ $sound->title}}</option>


@endforeach
@endforeach
</select>
</div>
<form>
<br>
{!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort klippet ur spellistan?");' )) !!}
{!! Form::close() !!}
</div>
</div>
<br>
<!-- script för att öppna formulären -->

@endif

@endforeach

@else 
<p style="font-family: 'Museo'; color: #26a09f;">Inga spellistor</p>
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

<!-- Script för tooltips -->
<script>
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

</body>
@stop