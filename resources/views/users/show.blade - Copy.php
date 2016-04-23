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
  <h1>Spellista</h1>
  <!-- lite kod för att hämta ut användarens spellistor -->
  <?php
  /* kollar listor hos användaren */
  $listsCheck = DB::table('playlists')->where('userID', '=', $user->userID)->first();

  ?>


  <!-- om användaren ej har spellista -->
  
  <!-- om användaren har spellista -->
   @if(!is_null($listsCheck))
  <!-- för var resultat -->
  <?php
  $lists = DB::table('playlists')->where('userID', '=', $user->userID)->get();
  ?>
  @foreach($lists as $list)
  <br>
  <h3>{{ $list->listTitle }}</h3><br>

@endforeach
  <?php
  /* genererar en list.xml */
  foreach($lists as $list){
  $listID = $list->listID;
  $sounds = DB::table('playlists')->where('listID', '=', $listID)->get(); 
  }
  $arr = array();
             
dd($sounds);

   
             
  ?>

<?php

$ADD = '';

$str ='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<music>';

$listItems = array_values(explode(',',$sounds->soundIDs,13));

foreach($listItems as $listItem){
  $GET = DB::table('sounds')->where('soundID', '=', $listItem)->get();
  foreach($GET as $GE){
    $URL = $GE->URL;
      $ADD .= '<song url="' . $URL .'"/>
      ';
  }

}

$str .= $ADD;
$str .='</music>';

echo $str;

$file_name="list.xml"; // file name
$fp = fopen ($file_name, "w"); 

fwrite ($fp,$str); 
fclose ($fp); 
chmod($file_name,0777); 
?>

@foreach($listItems as $listItem)
<?php
/* hämtar ut data för foreach loopen */
$sounds2 = DB::table('sounds')->where('soundID', '=', $listItem)->get();

?>


@endforeach
@else
<p>Den här användaren har inga spellistor än!</p>
@endif
  <!-- Innehåll här (List) -->
  </div>

  <div role="tabpanel" class="tab-pane" id="add">
  <h1>Namnlös</h1>
<!-- Innehåll här (plus flik ) -->
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
      </div>

          
     

			




@stop
