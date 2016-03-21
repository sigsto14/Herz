@extends('template')
@section('container')
@section('footer')
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
            <p>{{ $channel->information }}</p>    
          </div>
          <div class="row">
          </div>
          <div class="row">
          </div>
          <hr>
          <div class="row"> 
          @if(Auth::user())

<!-- php-kod för att kolla om det redan är favorit. Det fungerar ej med eloquent så vanlig sql/php löser problemet -->
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
@if(Auth::user()->userID == $channel->channelID)
@else
@if($state == 0)

<td>{!! Form::open(array('route' => 'subscribe.store')) !!}
 {!! csrf_field() !!}
<div>
        <input type="hidden" name="userID" value="{{ Auth::user()->userID }}">
</div>
<div>
        <input type="hidden" name="channelID" value="{{ $channel->channelID }}">
</div>
 


<button name="submit" type="submit" class="btn btn-default btn-md" id="fav-knapp">
              <span class=" glyphicon glyphicon-heart-empty" aria-hidden="true"  id="heart"></a><p> Prenumerera </p></span>
              </button>
{!! Form::close() !!}
@else

<td>{!! Form::open(array('method' => 'DELETE', 'route' => array('subscribe.destroy', $channel->channelID)))  !!}
      <button name="submit" type="submit" class="btn btn-default btn-md" id="fav-knapp">
              <span class="glyphicon glyphicon-heart" aria-hidden="true"id="heart"></a><p> Sluta prenumerera</p></span>
              </button>
{!! Form::close() !!}</td>

@endif
@endif





@if(Auth::user()->userID == $user->userID)
<a href="{{URL::route('channel.edit', array('id' => $user->userID)) }}">Redigera kanal</a><br>
@endif
@endif
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
          <div class="row">
          
          <?php
           $id = $user->userID;
              $sounds = DB::table('sounds')->where('channelID', '=', $id)->orderBy('sounds.created_at', 'desc')->get();  
          ?>
          @foreach($sounds as $sound)

           <h1>{{ $sound->title }}</h1> 
           <img src=" {{ $sound->podpicture }}" width="200px" height="auto"><br>
           <audio controls>
  <source src="{{ $sound->URL }}" type="audio/ogg">
  <source src="{{ $sound->URL }}" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
@if(Auth::check())
@if(Auth::user()->userID == $user->userID)
{!! csrf_field() !!}
{!!   Form::open(array('method' => 'DELETE', 'route' => array('sound.destroy', $sound->soundID))) !!}
{!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort ljudklippet?");' )) !!}
{!! Form::close() !!}
@endif
@endif
@endforeach

          </div>
     
          </div>   
          </div> 
         </div> 
        </div>
    </div> --><!-- /container -->
   
			
			



</body>
@stop