@extends('template')
@section('container')
@section('footer')

<?php
/* variabel för se hur många gånger ID förekommer i subscribetabell */
$subscrNr = DB::table('subscribe')->where('channelID', '=', $channel->channelID)->count();        
?> 

<!DOCTYPE HTML>

<title>{{ $channel->channelname }}</title>
<body>
@yield('content')
<!-- Kanal innehåll --> 
    <div class="container">
    <div class="col-md-12" id="container">
    <!-- Kanal header --> 
        <div class="channel_header">
        <img src="http://localhost/Herz/public/images/channel/default.png">
        </div>
        <!-- Första låda, här finns profil --> 
        <div class="col-lg-4">
          <div class="row">
            <h2>{{ $channel->channelname }}</h2>
            <p>Prenumeranter:{{ $subscrNr }}</p> 
            <p>{{ $channel->information }}</p>    
          </div>
          <div class="row">
          </div>
          <div class="row">
          </div>
          <hr>
          <div class="row"> 
          @if(Auth::user())

<!-- php-kod för att kolla om det redan är prenumeration. Det fungerar ej med eloquent så vanlig sql/php löser problemet -->
<?php
$userID = Auth::user()->userID;
$channelID = $channel->channelID;

$mysqli = new mysqli("localhost","root","","herz");

$query = <<<END
SELECT * FROM subscribe
WHERE userID = '{$userID}'
AND channelID = '{$channelID}'
END;

$res = $mysqli->query($query);
if($res->num_rows > 0){
  $state = 1;

}
else {

$state = 0;
}

?>
<!-- ^ sätter state 1 om man prenumererar och state 0 om man ej gör det -->
<!-- kollar om man är på sin egen sida innehåll om man är på sin egen kanal -->
@if(Auth::user()->userID == $channel->channelID)
@else
<!-- vy för icke prenumerant med formulär så den kan prenumerera -->
@if($state == 0)

<td>{!! Form::open(array('route' => 'subscribe.store')) !!}
 {!! csrf_field() !!}
<div>
        <input type="hidden" name="userID" value="{{ Auth::user()->userID }}">
</div>
<div>
        <input type="hidden" name="channelID" value="{{ $channel->channelID }}">
</div>
 


<button name="submit" type="submit" class="btn btn-default btn-lg" id="fav-knapp">
              <span class="glyphicon glyphicon-eye-open" aria-hidden="true"  id="heart"></a><p> Prenumerera </p></span>
              </button>
{!! Form::close() !!}
<!-- vy för prenumerant så den kan avprenumerera -->
@else

<td>{!! Form::open(array('method' => 'DELETE', 'route' => array('subscribe.destroy', $channel->channelID)))  !!}
 {!! csrf_field() !!}
      <button name="submit" type="submit" class="btn btn-default btn-lg" id="fav-knapp">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"id="heart"></a><p> Sluta prenumerera</p></span>
              </button>
{!! Form::close() !!}</td>

@endif
@endif




<!-- ifall man är på sin egen sida ska man få länk till att redigera den -->
@if(Auth::user()->userID == $user->userID)
<a href="{{URL::route('channel.edit', array('id' => $user->userID)) }}">Redigera kanal</a><br>
@endif
@endif
<!-- slut på prenumerationsdel (till vänster på sidan) -->
          </div>
        </div>
         <!-- Andra lådan, här fins podar -->
        <div class="col-lg-8"  id="tabus">        
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#">Sparade podcasts</a></li>
            <li role="presentation"><a href="#">Favoriter</a></li>
            <li role="presentation"><a href="#">Markerad lista</a></li>
            <li role="presentation"><a href="#">+</a></li>
          </ul>
          <br>
          <div class="spod">
          <!-- php-kod som kollar om klippet är favorit för inloggad användare eller ej -->
            <?php
           $id = $user->userID;
              $sounds = DB::table('sounds')->where('channelID', '=', $id)->orderBy('sounds.created_at', 'desc')->get();  
          ?>
           @foreach($sounds as $sound)
          @if(Auth::check())
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
  $state = 2;

}
else {

$state = 3;
}

?>
<!-- ^state 2 om det är favorit och state 3 om ej -->
@endif
<!-- visar upp alla ljud -->
          <div class="sb">
           <h1>{{ $sound->title }}</h1> 
           <img src=" {{ $sound->podpicture }}" width="200px" height="auto"><br>
           <audio controls>
  <source src="{{ $sound->URL }}" type="audio/ogg">
  <source src="{{ $sound->URL }}" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
<!-- kollar om användare är inloggad -->
@if(Auth::check())
<!-- kollar så att det INTE är inloggad användares kanal -->
@if($sound->channelID != Auth::user()->userID)
<!-- kollar så det inte är favorit redan och så man kan göra klippet till favorit -->
@if($state == 3)
<td>{!! Form::open(array('route' => 'favorite.store')) !!}
 {!! csrf_field() !!}</td>
<div>
        <input type="hidden" name="userID" value="{{ Auth::user()->userID }}">
</div>
<div>
        <input type="hidden" name="soundID" value="{{ $sound->soundID }}">
</div>
 

<div class="fvbox">
<button name="submit" type="submit" class="btn btn-default btn-md" id="fav-knapp">
              <span class=" glyphicon glyphicon-heart-empty" aria-hidden="true"  id="heart"></a><p> Lägg till favorit </p></span>
              </button></div>
{!! Form::close() !!}
<!-- om det redan är favorit kan man ta bort från favorit -->
@else
<td>{!! Form::open(array('method' => 'DELETE', 'route' => array('favorite.destroy', $sound->soundID)))  !!}

<div class="fvbox2">
      <button name="submit" type="submit" class="btn btn-default btn-md" id="fav-knapp">
              <span class="glyphicon glyphicon-heart" aria-hidden="true"id="heart"></a><p> Ta bort favorit</p></span>
              </button></div>

{!! Form::close() !!}</td>
@endif
@endif
<!-- slut på favoriter -->
<!-- kollar om det är den inloggade användarens kanal och då kan användaren ta bort ljudklipp -->
@if(Auth::user()->userID == $user->userID)

{!!   Form::open(array('method' => 'DELETE', 'route' => array('sound.destroy', $sound->soundID))) !!}
{!! csrf_field() !!}
{!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort ljudklippet?");' )) !!}
{!! Form::close() !!}
@endif
@endif
</div>


@endforeach


          </div>
          </div>
          </div>
          </div>   
          </div> 
<!-- /container -->
   
			<!--TADAAA!!-->
			



</body>
@stop