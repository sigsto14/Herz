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
            <!-- sätter variabler att senare testa mot i loopar för att skapa rekommendationer -->
            <?php
$userID = Auth::user()->userID;

            $favoriteIDs = DB::table('favorites')->join('sounds', 'sounds.soundID', '=', 'favorites.soundID')->join('channels', 'channels.channelID', '=', 'sounds.channelID')->get();
            /* vilka channels subbar användaren på, group by så det bara blir en av var */
            $channels = DB::table('subscribe')->join('channels', 'subscribe.channelID', '=', 'channels.channelID')->join('sounds', 'sounds.channelID', '=', 'channels.channelID')->groupBy('channels.channelID')->get();
            ?>

            @endif
            @endif
          </div>
        </div>
        <div class="col-lg-8"id="tabus">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#">Rekommendationer</a></li>


            
            <li role="presentation"><a href="#">Favoriter</a></li>
            <li role="presentation"><a href="#">Markerad lista</a></li>
            <li role="presentation"><a href="#">+</a></li>
          </ul>
          <br>
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
         })->orderBy('sounds.created_at', 'ASC')->paginate(5);

         ?>
         <!-- kör en loop för alla resultat -->
             @foreach($results as $result)
  <div class="row">
              <h3><a href="http://localhost/Herz/public/sound/{{$result->soundID}}">{{ $result->title }}</a></h3><br></div>
               <img src="{{ $result->podpicture }}" style="width:145px;height:159px;"/><br>
               
                <audio controls>
  <source src="{{ $result->URL }}" type="audio/ogg">
  <source src="{{ $result->URL }}" type="audio/mpeg">
Your browser does not support the audio element.
</audio>    <br><br><br><br>

            <p>Kanal <a href="http://localhost/Herz/public/channel/{{ $result->channelID }}">{{$result->channelname}}</a></p>
              
              
             
             @endforeach
             @endforeach

<!-- slut på ljudklipprekommendationer -->
<!-- rekommenderade kanaler -->

            
             
            
              @endif
              @endif

</div>
<!-- slut på rekommendationer -->

              <!-- tillfällig utkommentering
              <div class="col-md-4"><img src="http://localhost/Herz/public/images/podcast_av/pod.png">
              <h3>Herz Podcast</h3>
              <p>av Herz</p>
              </div>
              <div class="col-md-4"><img src="http://localhost/Herz/public/images/podcast_av/pod.png">
              <h3>Herz Podcast</h3>
              <p>av Herz</p>
              </div>
          </div>
          <br>    
          <div class="row">
              <div class="col-md-4"><img src="http://localhost/Herz/public/images/podcast_av/pod.png">
              <h3>Herz Podcast</h3>
              <p>av Herz</p>
              </div>
              <div class="col-md-4"><img src="http://localhost/Herz/public/images/podcast_av/pod.png">
              <h3>Herz Podcast</h3>
              <p>av Herz</p>
              </div>
              <div class="col-md-4"><img src="http://localhost/Herz/public/images/podcast_av/pod.png">
              <h3>Herz Podcast</h3>
              <p>av Herz</p>
              </div>    
          </div>-->
        </div>
      </div>
      </div>
      </div>

          
     

			




@stop
