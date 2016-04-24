@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>

<title>{{ $user->username }}</title>
@yield('content')
<!-- Kanal innehåll --> 
    <div class="container">
    <!-- Kanal header --> 
    
     <div class="col-md-12" id="container">
     <div class="channel_header">
        <img src="http://localhost/Herz/public/images/channel/default.png">
        </div>
        <!-- Första låda, här finns profil --> 
        <div class="col-lg-4">
          <div class="row">
            <h2>{{ $user->username }}</h2>
            <img src="{{ $user->profilePicture }}" style="width:145px;height:159px;"/>    
          </div>
          <div class="row">
          </div>
          <div class="row">
          </div>
          <hr>
          <div class="row"> 
          <!-- kollar om user inloggad -->
          @if(Auth::user())
          <!-- kolla om user inloggad stämmer överens om det id man är på (show-funktion från controller -->
            @if(Auth::user()->userID == $user->userID)
            <a href="{{URL::route('user.edit', array('id' => $user->userID)) }}">Ändra kontouppgifter</a><br>
            <?php
            /* kod för att kolla om användaren har kanal */
            $channelCheck = DB::table('channels')->where('channelID', '=', $user->userID)->first();
            ?>
            
            @if(is_null($channelCheck))
            <!-- om användaren ej har kanal -->
<a href="{{URL::route('channel.create', array('id' => $user->userID)) }}">Skapa kanal</a><br>
            @endif
            @endif
            @endif
             @if(Auth::user())
            <!-- sätter variabler att senare testa mot i loopar för att skapa rekommendationer -->
            <?php
$userID = Auth::user()->userID;

            $favoriteIDs = DB::table('favorites')->join('sounds', 'sounds.soundID', '=', 'favorites.soundID')->join('channels', 'channels.channelID', '=', 'sounds.channelID')->get();
            /* vilka channels subbar användaren på, group by så det bara blir en av var */
            $channels = DB::table('subscribe')->join('channels', 'subscribe.channelID', '=', 'channels.channelID')->join('sounds', 'sounds.channelID', '=', 'channels.channelID')->groupBy('channels.channelID')->get();
            ?>


            @endif
          </div>
        </div>
        <div class="col-lg-8"  id="tabus">        
          <ul class="nav nav-tabs" role="tablist" >
            <li role="presentation" class="active"><a href="#chome" role="tab" data-toggle="tab">Sparade podcasts</a></li>
            <li role="presentation"><a href="#fav" role="tab" data-toggle="tab">Favoriter</a></li>
            <li role="presentation"><a href="#list" role="tab" data-toggle="tab">Spellista</a></li>
            @if(Auth::check())
            @if(Auth::user()->userID = $user->userID)
            <li role="presentation"><a href="#add" role="tab" data-toggle="tab">+</a></li>
            @endif
            @endif
          </ul>
          <script>
$('#btnReview').click(function(){
  $(".tab-content").removeClass("active");
  $(".tab-content:first-child").addClass("active");
});

</script>
          <br>
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" id="container2">
            <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="chome">
             <!-- kollar om user inloggad -->
           @if(Auth::check())
               <!-- kolla om user inloggad stämmer överens om det id man är på (show-funktion från controller -->
            @if(Auth::user()->userID == $user->userID)
            <h1> Ljudklipp för dig:</h1>
            <!-- gör loopar av tidigare variabler -->
          @foreach($favoriteIDs as $favoriteID)
          <?php
/* fixar lite variabler så vi kan testa mot dem */
        
          $userID = Auth::user()->userID;
          $soundID = $favoriteID->soundID;
          $tag = $favoriteID->tag;
/* hämtar ut från channels och sounds som INTE finns i favorites redan för användaren */
/* gör en query för att "or where" inte ska krocka med where */
/* variablen hämtar ut ljudklipp där titel eller tagg liknar de som användaren har i sina favoriter */
         $results = DB::table('channels')->join('sounds', 'sounds.channelID', '=', 'channels.channelID')->where('sounds.soundID', '!=', $soundID)
         ->where(function($query) use($tag) {
             $query ->where('sounds.tag', 'LIKE', '%' . $tag . '%')
         ->orWhere('sounds.title', 'LIKE', '%' . $tag . '%');
         })->orderBy('sounds.created_at', 'ASC')->paginate(2);

         ?>
         <!-- kör en loop för alla resultat -->
             @foreach($results as $result)
@if($result->channelID != $userID)
  <div class="row">
              <h3><a href="http://localhost/Herz/public/sound/{{$result->soundID}}">{{ $result->title }}</a></h3><br></div>
               <img src="{{ $result->podpicture }}" style="width:145px;height:159px;"/><br>
               
                <audio controls>
  <source src="{{ $result->URL }}" type="audio/ogg">
  <source src="{{ $result->URL }}" type="audio/mpeg">
Your browser does not support the audio element.
</audio>    <br><br><br><br>

            <p>Kanal <a href="http://localhost/Herz/public/channel/{{ $result->channelID }}">{{$result->channelname}}</a></p>
              
              @endif
             
             @endforeach
             @endforeach

<!-- slut på ljudklipprekommendationer -->
<!-- rekommenderade kanaler -->

            
             
            
              @endif
              @endif

</div>
                <div role="tabpanel" class="tab-pane" id="fav">
  <h1>Favoriter</h1>
  <!-- Innehåll här (Favoriter) -->
  </div>
   <div role="tabpanel" class="tab-pane" id="list">

  <!-- lite kod för att hämta ut användarens spellistor -->
  <h1>Spellistor</h1>
  <?php
$playlists = DB::table('playlists')->where('userID', '=', $user->userID)->orderBy('created_at', 'ASC')->take(5)->get();
$playlistsCheck = DB::table('playlists')->where('userID', '=', $user->userID)->first();


  ?>
  @if(is_null($playlistsCheck))
  <p>Oj oj, här var det tomt! {{ $user->username }} har inga spellistor än</p>
  @else
<ul class="nav nav-tabs" role="tablist" >
            <li role="presentation" class="active"><a href="#senaste" role="tab" data-toggle="tab">Senaste</a></li>
 
  @foreach($playlists as $playlist)
     <li class="nav nav-tabs" role="tablist"><a href="#{{ $playlist->listID }}" role="tab" data-toggle="tab">{{ $playlist->listTitle }}</a></li>
        



  @endforeach
</ul>
      @foreach($playlists as $playlist)

  <div class="tab-content">
<div role="tabpanel" class="tab-pane" id="{{ $playlist->listID }}">
         
  <h2><a href="http://localhost/Herz/public/playlist/{{ $playlist->listID }}">{{ $playlist->listTitle }}</a></h2>
   <br>
     <h4>Beskrivning</h4><br><p>{{ $playlist->listDescription }}</p>

   <div id="box1">

    <form action="" method="put" name="play" id="play">
<input type="hidden" name="listID" value="{{ $playlist->listID }}" id="listID">
    <button type="submit" class="btn btn-default btn-lg" id="play">
  <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
</button>
 </form>  </div>

@if(Auth::check())
@if(Auth::user()->userID == $user->userID )
{!!   Form::open(array('method' => 'DELETE', 'route' => array('playlist.destroy', $playlist->listID))) !!}
{!! csrf_field() !!}
{!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort spellistan?");' )) !!}
{!! Form::close() !!}
@endif
@endif

  </div>
  </div>

 
   @endforeach
   
  
<script>

$('#play').submit(function(e){
e.preventDefault();
$("#box1").load( "http://localhost/Herz/public/player.html" );
var listID = $('#listID').val();
   var listID = $.trim(listID);
     var userID = $('#userID').val();
   var userID = $.trim(userID);
 
$.ajax({

       url: 'http://localhost/Herz/public/list.php',
       data: { listID: listID, userID: userID},
       dataType: 'json',
       success: function(data){
            //data returned from php
       }
    });
 

});
</script>
  @endif
  <!-- Innehåll här (List) -->
  </div>
</div>

</div>
<!-- slut på rekommendationer -->
   
       
        </div>

      </div>

      </div>
      </div>
      </div>


@stop
