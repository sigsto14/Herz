
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
            @if(Auth::check())
            @if(Auth::user()->userID == $user->userID)
            <li role="presentation" class="active"><a href="#chome" role="tab" data-toggle="tab">Sparade podcasts</a></li>
            <li role="presentation"><a href="#fav" role="tab" data-toggle="tab">Favoriter</a></li>
            
            <li class="dropdown">
            <a href="#" data-toggle="dropdown">Spellista<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a href="#list1" role="tab" data-toggle="tab">Lis1</a></li>
                                    <li role="presentation"><a href="#list2" role="tab" data-toggle="tab">Lis2</a></li>
                                    <li role="presentation"><a href="#list3" role="tab" data-toggle="tab">Lis3</a></li>
                                    <li role="presentation"><a href="#list4" role="tab" data-toggle="tab">Lis4</a></li>
                                    <li role="presentation"><a href="#list5" role="tab" data-toggle="tab">Lis5</a></li>
                                </ul>
                            </li>
            <li role="presentation"><a href="#add" role="tab" data-toggle="tab">+</a></li>
            @else
            <li role="presentation"><a href="#fav" role="tab" data-toggle="tab">+</a></li>
            <li class="dropdown">
            <a href="#" data-toggle="dropdown">Spellista<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a href="#list1" role="tab" data-toggle="tab">Lis1</a></li>
                                    <li role="presentation"><a href="#list2" role="tab" data-toggle="tab">Lis2</a></li>
                                    <li role="presentation"><a href="#list3" role="tab" data-toggle="tab">Lis3</a></li>
                                    <li role="presentation"><a href="#list4" role="tab" data-toggle="tab">Lis4</a></li>
                                    <li role="presentation"><a href="#list5" role="tab" data-toggle="tab">Lis5</a></li>
                                </ul>
                            </li>
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
   <div role="tabpanel" class="tab-pane" id="add">

  <!-- lite kod för att hämta ut användarens spellistor -->
  <h1>Namnlös</h1>
  
</div>
   <div role="tabpanel" class="tab-pane" id="list1">

  <!-- lite kod för att hämta ut användarens spellistor -->
  <h1>List 1</h1>
  
</div>
   <div role="tabpanel" class="tab-pane" id="list2">

  <!-- lite kod för att hämta ut användarens spellistor -->
  <h1>List 2</h1>
  
</div>
   <div role="tabpanel" class="tab-pane" id="list3">

  <!-- lite kod för att hämta ut användarens spellistor -->
  <h1>Lits 3</h1>
  
</div>
   <div role="tabpanel" class="tab-pane" id="list4">

  <!-- lite kod för att hämta ut användarens spellistor -->
  <h1>List 4</h1>
  
</div>
   <div role="tabpanel" class="tab-pane" id="list5">

  <!-- lite kod för att hämta ut användarens spellistor -->
  <h1>List 5</h1>
  
</div>



  <!-- Innehåll här (List) -->
  </div>
</div>

  </div>
</div>
<!-- slut på rekommendationer -->
   
          </div>
        </div>

      </div>

      </div>
      </div>
      </div>


@stop
