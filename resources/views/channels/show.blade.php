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
@if(Auth::user()->userID == $user->userID)
{!! csrf_field() !!}
{!!   Form::open(array('method' => 'DELETE', 'route' => array('sound.destroy', $sound->soundID))) !!}
{!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort ljudklippet?");' )) !!}
{!! Form::close() !!}
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