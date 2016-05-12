
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
        <div class="col-lg-4" id="user-box">
          <div class="row">
            <h2>{{ $user->username }}</h2>
            <img src="{{ $user->profilePicture }}" style="width:180px;height:180px;"/>    
          </div>
           <hr>
          <div class="row">
          </div>
          <div class="row" >
          </div>
          <div class="row" id="usinfobox">
          <h4>Information</h4>
          <hr>
          <p>{{ $user->information }}</p>
          </div>
          <br>
          <div class="row" id="usinfobox">
          <h4>Senaste aktivitet</h4>
          <hr>
          <!-- gömt formulär för att kunna hämta aktiviteter med ajax -->
          <form id="act" action="" method="post">
          <!-- input användarnamn -->
          <input type="hidden" id="username" value="{{ $user->username }}">
          <!-- input användarid -->
          <input type="hidden" id="userID" value="{{ $user->userID }}">
          </form>
          <ul id="activity">
         </ul>
         <!-- script för att hämta ut aktiviteter -->
         <script>

          $(document).ready(function()
{
  function actTrigger(){
   
$('#act').trigger('submit');

}
    $('#act').submit(function(e)
  {

    e.preventDefault();
var userID = $('#userID').val();
var username = $('#username').val();

$.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://localhost/Herz/public/activity.php',
  data: { userID: userID, username: username},  
        dataType: 'text',

   success: function(data){ 
    $('#activity').html(data);

  },
   error: function() {}


 });
  });
actTrigger();
    });
         </script>
          </div>
          <br>
          @if(Auth::user())
          <!-- kolla om user inloggad stämmer överens om det id man är på (show-funktion från controller -->
          @if(Auth::user()->userID == $user->userID)
         <div class="row" id="uc-redigering">   
         <ul>
            <li id="ucli1">
            <?php
            /* kod för att kolla om användaren har kanal */
            $channelCheck = DB::table('channels')->where('channelID', '=', $user->userID)->first();
            ?>
            
            @if(is_null($channelCheck))
            <!-- om användaren ej har kanal -->           
              <a href="{{URL::route('channel.create', array('id' => $user->userID)) }}">Skapa kanal</a><br>
              @else
              <a href="{{URL::route('channel.show', array('id' => $user->userID)) }}">Kolla din kanal</a><br> 
            @endif              
            </li>        
            <li id="ucli2">
              <a href="{{URL::route('user.edit', array('id' => $user->userID)) }}">Ändra kontouppgifter</a><br>
            </li> 
            <ul>       
          </div>
             @endif       
            @endif
 @if(Auth::user())
            <!-- sätter variabler att senare testa mot i loopar för att skapa rekommendationer -->
            <?php
$userID = Auth::user()->userID;
            $favoriteIDs = DB::table('favorites')->join('sounds', 'sounds.soundID', '=', 'favorites.soundID')->join('channels', 'channels.channelID', '=', 'sounds.channelID')->get();
                 $favoriteCheck = DB::table('favorites')->first();
            /* vilka channels subbar användaren på, group by så det bara blir en av var */
            $channels = DB::table('subscribe')->join('channels', 'subscribe.channelID', '=', 'channels.channelID')->join('sounds', 'sounds.channelID', '=', 'channels.channelID')->groupBy('channels.channelID')->get();
            ?>

            @endif

</div>
        <div class="col-lg-8"  id="uc-tabus">        
          <ul class="nav nav-tabs" role="tablist" >
           <li role="presentation" class="active"><a href="#chome" role="tab" data-toggle="tab">Favoriter</a></li>

            @if(Auth::check())
            @if(Auth::user()->userID == $user->userID)

           


 @endif
                 @endif 
                         <li class="dropdown"> 
            <!-- php för att hämta ut spellistor så vi kan presentera dessa i meny -->
                <?php
              /* behöver fylla en array senare */
              $array = '';
              /* hämtar playlists*/
              $playlists = DB::table('playlists')->where('userID', '=', $user->userID)->orderBy('created_at', 'ASC')->take(5)->get();
              /*kollar hur många resultat som går att ta ut så att vi kan använda detta i if-satser senare */
              $count = DB::table('playlists')->where('userID', '=', $user->userID)->orderBy('created_at', 'ASC')->take(5)->count();
              /* en variabel för o kolla om det är tomt */
              $playlistsCheck = DB::table('playlists')->where('userID', '=', $user->userID)->first();
              /* en foreach loop för att sätta in värden i vår array */
              foreach($playlists as $playlist){
              if($playlist->listID == $playlistsCheck->listID){
              /* det första värdet ska ej ha , */
              $array .= $playlist->listID;
              }
              else{
              /* de andra värdena ska skiljas med , */
              $array .= ',' . $playlist->listID;
              }
              }
              /* gör en array av värdena vi satt in i variabeln för arrayen */
              $lists = array_values(explode(',',$array,10));
              $li = '';
              /* med hjälp av att kolla hur många resultat vi fick gör vi variabler av värdena i arrayen */
              /* variabler för var resultat (max 5) */
              /* detta för att javascript och ny xml ej fungerar med foreach loop och id'n */
              if($count > 0){
              $listID1 = $lists[0]; 
              $list1 = DB::table('playlists')->where('listID', '=', $listID1)->first();
              $li .= '<li role="presentation"><a href="#list1" role="tab" data-toggle="tab">' . $list1->listTitle . '</a></li>';
              }
              if($count > 1){
              $listID2 = $lists[1];
              $list2 = DB::table('playlists')->where('listID', '=', $listID2)->first();
              $li .= '<li role="presentation"><a href="#list2" role="tab" data-toggle="tab">' . $list2->listTitle . '</a></li>';
              }
              if($count > 2){
              $listID3 = $lists[2];
              $list3 = DB::table('playlists')->where('listID', '=', $listID3)->first();
              $li .= '<li role="presentation"><a href="#list3" role="tab" data-toggle="tab">' . $list3->listTitle . '</a></li>';
              }
              if($count > 3){
              $listID4 = $lists[3];
              $list4 = DB::table('playlists')->where('listID', '=', $listID4)->first();
              $li .= '<li role="presentation"><a href="#list4" role="tab" data-toggle="tab">' . $list4->listTitle . '</a></li>';
              }
              if($count > 4){
              $listID5 = $lists[4];
              $list5 = DB::table('playlists')->where('listID', '=', $listID5)->first();
              $li .= '<li role="presentation"><a href="#list5" role="tab" data-toggle="tab">' . $list5->listTitle . '</a></li>';
              }
              $lo = html_entity_decode($li, ENT_QUOTES);
              ?>
             @if($count >0)
            <a href="#" data-toggle="dropdown" id="pil">Spellista<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu" id="colordrop">
                                    <?php echo $lo ?>
                                </ul>
                                @endif

                                <li role="presentation"><a href="#fav" role="tab" data-toggle="tab">Rekommendationer</a></li>
                                <li role="presentation"><a href="#fav" role="add" data-toggle="tab">+</a></li>
            <li class="dropdown">
   
 
           
          </ul>
          <script>
$('#btnReview').click(function(){
  $(".tab-content").removeClass("active");
  $(".tab-content:first-child").addClass("active");
});


</script>
            <div class="col-md-9" id="container2">
            <div class="tab-content">
             <div role="tabpanel" class="tab-pane active" class="tab-pane" id="chome">

  <h1 id="uc-title">Favoriter</h1>
  <br>
  <!-- Innehåll här (Favoriter) -->
  <?php
$favorites1 = DB::table('favorites')->join('sounds', 'favorites.soundID', '=', 'sounds.soundID')->join('users', 'users.userID', '=', 'favorites.userID')->get();
$userID = $user->userID;
/* gör en variabel för att hämta ut alla favoriter användaren har **/
$favorites = DB::table('favorites')->where('favorites.userID', '=', $userID)->join('sounds', 'favorites.soundID', '=', 'sounds.soundID')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->simplePaginate(4);
$loadMore = $favorites->render();
?>


 @foreach($favorites as $favorite)  
           <div class="col-md-5" id="uc-box">
               <a href="http://localhost/Herz/public/sound/{{ $favorite->soundID }}"><image src="{{ $favorite->podpicture }}" width="150px" height="150" id="pod-mini-img"></a>
               <div class="podtitle-box">
               <a href="http://localhost/Herz/public/sound/{{ $favorite->soundID }}"><h4>{{ $favorite->title }}</h4></a>
               <div class="podtitledownbox">
              <div class="podfavicon2">
                <div class="vertical-line2"></div>
                 <button class="button"><span class="icon-heart4"></span></button>
                </div>     
            <div class="podchanneltitle">
              
              <p>av <a href="http://localhost/Herz/public/channel/{{ $favorite->channelID }}">{{ $favorite->channelname}}</a></p>
              </div>
              </div>
              </div> 


 </div> 

         @endforeach
        
           
           <?php echo $loadMore ?>

  </div>

            <div role="tabpanel" class="tab-pane" id="fav">
             <!-- kollar om user inloggad -->
           @if(Auth::check())
               <!-- kolla om user inloggad stämmer överens om det id man är på (show-funktion från controller -->
            @if(Auth::user()->userID == $user->userID)
            <h1 id="uc-title"> Ljudklipp för dig:</h1>
            <!-- gör loopar av tidigare variabler -->
           @if(is_null($favoriteCheck))
           <p>Inga rekommendationer</p>
           @else
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
         @endforeach
         <!-- kör en loop för alla resultat -->
             @foreach($results as $result)
@if($result->channelID != $userID)
  <div class="col-md-5" id="uc-box">
  <div class="pod_mini">
<div id="flashContent">
              <embed src="http://localhost/Herz/public/pod_mini/mp3_player.swf" style="width:250px;height:50px;">
            </div>
</div>
<div class="podtitle-box">
           <a href="http://localhost/Herz/public/sound/{{$result->soundID}}"><h4>{{ $result->title }}</h4></a>   
<div class="podtitledownbox">

<div class="podfavicon">
<div class="vertical-line2"></div>
                  <button name="submit" type="submit" class="btn btn-default btn-md" id="fav-knapp"><span class=" glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
              </button>
              
                </div>

             <div class="podchanneltitle">   
            <p>av <a href="http://localhost/Herz/public/channel/{{ $result->channelID }}">{{$result->channelname}}</a></p>
              </div>
               
                    </div> 
           </div>
           </div>
              @endif
             
             
             @endforeach
@endif
<!-- slut på ljudklipprekommendationer -->
<!-- rekommenderade kanaler -->

            
             
            
              @endif
              @endif

</div>



               
   <div role="tabpanel" class="tab-pane" id="add">


  <h1 id="uc-title">Namnlös</h1>
  
</div>
<!--Första spellistan om den finns-->
@if($count > 0)
   <div role="tabpanel" class="tab-pane" id="list1">
<!-- matar ut första spellistan -->
 <a href="http://localhost/Herz/public/playlist/{{ $listID1 }}"> <h1 id="uc-title">{{ $list1->listTitle}}</h1></a>
 <!-- div för spellistacontent -->
  <div id="spelinfobox">
  <h4>Beskrivning av spellistan</h4>
 <hr>
 <p>{{ $list1->listDescription }}</p>
 </div>
 <!-- spellistans meny -->
  <div class="playlistmenu">
  <ul>
        <li>    
        <!-- formulär vars innehåll skickas till php-fil för att generera xml -->             
            <form action="" method="put" name="play1" id="play">
                <input type="hidden" name="listID" value="{{ $list1->listID }}" id="listID">
                <!-- knappen sätter igång js som laddar in listan -->
                  <button type="submit" tooltip="Öppna spellistan" class="knp knp-7 knp-7e knp-icon-only icon-down" id="playOpen">
                      <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                     </button>
                </form><!-- slut på formulär till xml -->
                   </li>
                   <li>
                   <!-- stänger listan -->
                    <button type="submit" tooltip="Stäng spellistan" class="knp knp-7 knp-7e knp-icon-only icon-up hidden" id="playClose">
                   </li>    
                   <!-- om användare inloggad -->               
                    @if(Auth::check())
                    <!-- om användare äger spellista -->
                    @if(Auth::user()->userID == $user->userID)                 
                    <li>
                    <!-- formulär för att radera spellistan -->
                     {!!   Form::open(array('method' => 'DELETE', 'route' => array('playlist.destroy', $listID1))) !!}
                    {!! csrf_field() !!}
                 <!-- submit o confirma spellistan ska bort -->
            <button type="submit" tooltip="Ta bort spellistan" class="knp knp-7 knp-7e knp-icon-only icon-delete" onclick="return confirm('Säker på att du vill ta bort spellistan?')">Like</button>
               {!! Form::close() !!}         <!-- slut på delete formulär -->     
                   </li>
                   <li>
                   <!-- knapp som öppnar redigera spellista i nytt fönster -->
                  <button type="button" tooltip="Inställningar" class="knp knp-7 knp-7e knp-icon-only icon-settings" onclick="edit()">Like</button>
                   </li>
                         @endif <!-- slut på auth check -->
                   @endif <!-- slut på koll om användare äger spellista -->
                   <li>
                   <!-- knapp startar script som öppnar spellistan i nytt fönster (och genererar xml) -->
                    <button type="button" tooltip="Extern spellista" class="knp knp-7 knp-7e knp-icon-only icon-bigger" onclick="open1();"></button>
                    </li>
                    <li id="playlist-right">
            
             <!-- facebook dela knapp, tillfälligt inaktiv -->
              <button type="button" onclick="share()" tooltip="Dela på Facebook" class="knp knp-7 knp-7f knp-icon-only fb-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              </li>    
          

         
                   <ul> 
   </div>                 
<!-- en box som spellistan laddas in i senare -->
                    <div id="box1"></div>

</div>
   <script>
          function open1() {
       //öppnar spellistan i externt fönster
var player = window.open("http://localhost/Herz/public/playlistPlayer/mp3_player.swf", "_blank", "titlebar=no,toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=350");
// sätter igång formuläret som genom ajax skickar till php-fil som genererar xml-fil
 $('#play').trigger('submit');
}
      function edit() {
    //öppnar edit playlists i nytt fönster
window.open("http://localhost/Herz/public/playlist", "_blank", "scrollbars=yes,width=615,height=800");
}
    // om man trycker på öppna spellistan knappen
$('#playOpen').click(function(){
//lägga till hidden clss o ta bort hidden från stängknappen
$(this).toggleClass('hidden');
$('#playClose').toggleClass('hidden');
});

$('#playClose').click(function(){
  //stängknappen tar bort innehåll i boxen och ändrar från hidden
$("#box1").html('');
$(this).toggleClass('hidden');
$('#playOpen').toggleClass('hidden');
});
//formuläret till xml
                      $('#play').submit(function(e){
                      e.preventDefault();
                      //laddar in spelaren
                      $("#box1").load( "http://localhost/Herz/public/player.html" );
     //variabler som åker med till php fil för att identifiera spellista
                      var listID = $('#listID').val();
                      var userID = $('#userID').val();

                      $.ajax({
                        // php-filens url
                      url: 'http://localhost/Herz/public/list.php',
                      //skickar med data
                      data: { listID: listID, userID: userID},
                      dataType: 'json',
                      success: function(data){            
                      }
                      });
                      });
                    </script>
@endif<!--slut på lista 1 -->

@if($count > 1)
     <div role="tabpanel" class="tab-pane" id="list2">
<!-- matar ut första spellistan -->
 <a href="http://localhost/Herz/public/playlist/{{ $listID2 }}"> <h1 id="uc-title">{{ $list2->listTitle}}</h1></a>
 <!-- div för spellistacontent -->
  <div id="spelinfobox">
  <h4>Beskrivning av spellistan</h4>
 <hr>
 <p>{{ $list2->listDescription }}</p>
 </div>
 <!-- spellistans meny -->
  <div class="playlistmenu">
  <ul>
        <li>    
        <!-- formulär vars innehåll skickas till php-fil för att generera xml -->             
            <form action="" method="put" name="play2" id="play2">
                <input type="hidden" name="listID2" value="{{ $list2->listID }}" id="listID2">
                <!-- knappen sätter igång js som laddar in listan -->
                  <button type="submit" tooltip="Öppna spellistan" class="knp knp-7 knp-7e knp-icon-only icon-down" id="playOpen2">
                      <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                     </button>
                </form><!-- slut på formulär till xml -->
                   </li>
                   <li>
                   <!-- stänger listan -->
                    <button type="submit" tooltip="Stäng spellistan" class="knp knp-7 knp-7e knp-icon-only icon-up hidden" id="playClose2">
                   </li>    
                   <!-- om användare inloggad -->               
                    @if(Auth::check())
                    <!-- om användare äger spellista -->
                    @if(Auth::user()->userID == $user->userID)                 
                    <li>
                    <!-- formulär för att radera spellistan -->
                     {!!   Form::open(array('method' => 'DELETE', 'route' => array('playlist.destroy', $listID2))) !!}
                    {!! csrf_field() !!}
                 <!-- submit o confirma spellistan ska bort -->
            <button type="submit" tooltip="Ta bort spellistan" class="knp knp-7 knp-7e knp-icon-only icon-delete" onclick="return confirm('Säker på att du vill ta bort spellistan?')">Like</button>
               {!! Form::close() !!}         <!-- slut på delete formulär -->     
                   </li>
                   <li>
                   <!-- knapp som öppnar redigera spellista i nytt fönster -->
                  <button type="button" tooltip="Inställningar" class="knp knp-7 knp-7e knp-icon-only icon-settings" onclick="edit()">Like</button>
                   </li>
                         @endif <!-- slut på auth check -->
                   @endif <!-- slut på koll om användare äger spellista -->
                   <li>
                   <!-- knapp startar script som öppnar spellistan i nytt fönster (och genererar xml) -->
                    <button type="button" tooltip="Extern spellista" class="knp knp-7 knp-7e knp-icon-only icon-bigger" onclick="open2();"></button>
                    </li>
                    <li id="playlist-right">
            
             <!-- facebook dela knapp, tillfälligt inaktiv -->
              <button type="button" onclick="share()" tooltip="Dela på Facebook" class="knp knp-7 knp-7f knp-icon-only fb-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              </li>    
          

         
                   <ul> 
   </div>                 
<!-- en box som spellistan laddas in i senare -->
                    <div id="box2"></div>

</div>
   <script>
          function open2() {
       //öppnar spellistan i externt fönster
var player = window.open("http://localhost/Herz/public/playlistPlayer/mp3_player.swf", "_blank", "titlebar=no,toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=350");
// sätter igång formuläret som genom ajax skickar till php-fil som genererar xml-fil
 $('#play2').trigger('submit');
}
      function edit() {
    //öppnar edit playlists i nytt fönster
window.open("http://localhost/Herz/public/playlist", "_blank", "scrollbars=yes,width=615,height=800");
}
    // om man trycker på öppna spellistan knappen
$('#playOpen2').click(function(){
//lägga till hidden clss o ta bort hidden från stängknappen
$(this).toggleClass('hidden');
$('#playClose2').toggleClass('hidden');
});

$('#playClose2').click(function(){
  //stängknappen tar bort innehåll i boxen och ändrar från hidden
$("#box2").html('');
$(this).toggleClass('hidden');
$('#playOpen2').toggleClass('hidden');
});
//formuläret till xml
                      $('#play2').submit(function(e){
                      e.preventDefault();
                      //laddar in spelaren
                      $("#box2").load( "http://localhost/Herz/public/player.html" );
     //variabler som åker med till php fil för att identifiera spellista
                      var listID2 = $('#listID2').val();
                      var userID2 = $('#userID2').val();

                      $.ajax({
                        // php-filens url
                      url: 'http://localhost/Herz/public/list2.php',
                      //skickar med data
                      data: { listID2: listID2, userID2: userID2},
                      dataType: 'json',
                      success: function(data){            
                      }
                      });
                      });
                    </script>
@endif<!-- slut lista 2 -->

<!-- start lista 3 -->
@if($count > 2)
     <div role="tabpanel" class="tab-pane" id="list3">
<!-- matar ut första spellistan -->
 <a href="http://localhost/Herz/public/playlist/{{ $listID3 }}"> <h1 id="uc-title">{{ $list3->listTitle}}</h1></a>
 <!-- div för spellistacontent -->
  <div id="spelinfobox">
  <h4>Beskrivning av spellistan</h4>
 <hr>
 <p>{{ $list3->listDescription }}</p>
 </div>
 <!-- spellistans meny -->
  <div class="playlistmenu">
  <ul>
        <li>    
        <!-- formulär vars innehåll skickas till php-fil för att generera xml -->             
            <form action="" method="put" name="play3" id="play3">
                <input type="hidden" name="listID3" value="{{ $list3->listID }}" id="listID3">
                <!-- knappen sätter igång js som laddar in listan -->
                  <button type="submit" tooltip="Öppna spellistan" class="knp knp-7 knp-7e knp-icon-only icon-down" id="playOpen3">
                      <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                     </button>
                </form><!-- slut på formulär till xml -->
                   </li>
                   <li>
                   <!-- stänger listan -->
                    <button type="submit" tooltip="Stäng spellistan" class="knp knp-7 knp-7e knp-icon-only icon-up hidden" id="playClose3">
                   </li>    
                   <!-- om användare inloggad -->               
                    @if(Auth::check())
                    <!-- om användare äger spellista -->
                    @if(Auth::user()->userID == $user->userID)                 
                    <li>
                    <!-- formulär för att radera spellistan -->
                     {!!   Form::open(array('method' => 'DELETE', 'route' => array('playlist.destroy', $listID3))) !!}
                    {!! csrf_field() !!}
                 <!-- submit o confirma spellistan ska bort -->
            <button type="submit" tooltip="Ta bort spellistan" class="knp knp-7 knp-7e knp-icon-only icon-delete" onclick="return confirm('Säker på att du vill ta bort spellistan?')">Like</button>
               {!! Form::close() !!}         <!-- slut på delete formulär -->     
                   </li>
                   <li>
                   <!-- knapp som öppnar redigera spellista i nytt fönster -->
                  <button type="button" tooltip="Inställningar" class="knp knp-7 knp-7e knp-icon-only icon-settings" onclick="edit()">Like</button>
                   </li>
                         @endif <!-- slut på auth check -->
                   @endif <!-- slut på koll om användare äger spellista -->
                   <li>
                   <!-- knapp startar script som öppnar spellistan i nytt fönster (och genererar xml) -->
                    <button type="button" tooltip="Extern spellista" class="knp knp-7 knp-7e knp-icon-only icon-bigger" onclick="open3();"></button>
                    </li>
                    <li id="playlist-right">
            
             <!-- facebook dela knapp, tillfälligt inaktiv -->
              <button type="button" onclick="share()" tooltip="Dela på Facebook" class="knp knp-7 knp-7f knp-icon-only fb-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              </li>    
          

         
                   <ul> 
   </div>                 
<!-- en box som spellistan laddas in i senare -->
                    <div id="box3"></div>

</div>
   <script>
          function open3() {
       //öppnar spellistan i externt fönster
var player = window.open("http://localhost/Herz/public/playlistPlayer/mp3_player.swf", "_blank", "titlebar=no,toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=350");
// sätter igång formuläret som genom ajax skickar till php-fil som genererar xml-fil
 $('#play3').trigger('submit');
}
      function edit() {
    //öppnar edit playlists i nytt fönster
window.open("http://localhost/Herz/public/playlist", "_blank", "scrollbars=yes,width=615,height=800");
}
    // om man trycker på öppna spellistan knappen
$('#playOpen3').click(function(){
//lägga till hidden clss o ta bort hidden från stängknappen
$(this).toggleClass('hidden');
$('#playClose3').toggleClass('hidden');
});

$('#playClose3').click(function(){
  //stängknappen tar bort innehåll i boxen och ändrar från hidden
$("#box3").html('');
$(this).toggleClass('hidden');
$('#playOpen3').toggleClass('hidden');
});
//formuläret till xml
                      $('#play3').submit(function(e){
                      e.preventDefault();
                      //laddar in spelaren
                      $("#box3").load( "http://localhost/Herz/public/player.html" );
     //variabler som åker med till php fil för att identifiera spellista
                      var listID3 = $('#listID3').val();
                      var userID3 = $('#userID3').val();

                      $.ajax({
                        // php-filens url
                      url: 'http://localhost/Herz/public/list3.php',
                      //skickar med data
                      data: { listID3: listID3, userID3: userID3},
                      dataType: 'json',
                      success: function(data){            
                      }
                      });
                      });
                    </script>
@endif<!-- slut lista 3 -->

<!-- start lista 4 -->
@if($count > 3)
        <div role="tabpanel" class="tab-pane" id="list4">
<!-- matar ut första spellistan -->
 <a href="http://localhost/Herz/public/playlist/{{ $listID4 }}"> <h1 id="uc-title">{{ $list4->listTitle}}</h1></a>
 <!-- div för spellistacontent -->
  <div id="spelinfobox">
  <h4>Beskrivning av spellistan</h4>
 <hr>
 <p>{{ $list4->listDescription }}</p>
 </div>
 <!-- spellistans meny -->
  <div class="playlistmenu">
  <ul>
        <li>    
        <!-- formulär vars innehåll skickas till php-fil för att generera xml -->             
            <form action="" method="put" name="play4" id="play4">
                <input type="hidden" name="listID4" value="{{ $list4->listID }}" id="listID4">
                <!-- knappen sätter igång js som laddar in listan -->
                  <button type="submit" tooltip="Öppna spellistan" class="knp knp-7 knp-7e knp-icon-only icon-down" id="playOpen4">
                      <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                     </button>
                </form><!-- slut på formulär till xml -->
                   </li>
                   <li>
                   <!-- stänger listan -->
                    <button type="submit" tooltip="Stäng spellistan" class="knp knp-7 knp-7e knp-icon-only icon-up hidden" id="playClose4">
                   </li>    
                   <!-- om användare inloggad -->               
                    @if(Auth::check())
                    <!-- om användare äger spellista -->
                    @if(Auth::user()->userID == $user->userID)                 
                    <li>
                    <!-- formulär för att radera spellistan -->
                     {!!   Form::open(array('method' => 'DELETE', 'route' => array('playlist.destroy', $listID4))) !!}
                    {!! csrf_field() !!}
                 <!-- submit o confirma spellistan ska bort -->
            <button type="submit" tooltip="Ta bort spellistan" class="knp knp-7 knp-7e knp-icon-only icon-delete" onclick="return confirm('Säker på att du vill ta bort spellistan?')">Like</button>
               {!! Form::close() !!}         <!-- slut på delete formulär -->     
                   </li>
                   <li>
                   <!-- knapp som öppnar redigera spellista i nytt fönster -->
                  <button type="button" tooltip="Inställningar" class="knp knp-7 knp-7e knp-icon-only icon-settings" onclick="edit()">Like</button>
                   </li>
                         @endif <!-- slut på auth check -->
                   @endif <!-- slut på koll om användare äger spellista -->
                   <li>
                   <!-- knapp startar script som öppnar spellistan i nytt fönster (och genererar xml) -->
                    <button type="button" tooltip="Extern spellista" class="knp knp-7 knp-7e knp-icon-only icon-bigger" onclick="open4();"></button>
                    </li>
                    <li id="playlist-right">
            
             <!-- facebook dela knapp, tillfälligt inaktiv -->
              <button type="button" onclick="share()" tooltip="Dela på Facebook" class="knp knp-7 knp-7f knp-icon-only fb-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              </li>    
          

         
                   <ul> 
   </div>                 
<!-- en box som spellistan laddas in i senare -->
                    <div id="box4"></div>

</div>
   <script>
          function open4() {
       //öppnar spellistan i externt fönster
var player = window.open("http://localhost/Herz/public/playlistPlayer/mp3_player.swf", "_blank", "titlebar=no,toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=350");
// sätter igång formuläret som genom ajax skickar till php-fil som genererar xml-fil
 $('#play4').trigger('submit');
}
      function edit() {
    //öppnar edit playlists i nytt fönster
window.open("http://localhost/Herz/public/playlist", "_blank", "scrollbars=yes,width=615,height=800");
}
    // om man trycker på öppna spellistan knappen
$('#playOpen4').click(function(){
//lägga till hidden clss o ta bort hidden från stängknappen
$(this).toggleClass('hidden');
$('#playClose4').toggleClass('hidden');
});

$('#playClose4').click(function(){
  //stängknappen tar bort innehåll i boxen och ändrar från hidden
$("#box4").html('');
$(this).toggleClass('hidden');
$('#playOpen4').toggleClass('hidden');
});
//formuläret till xml
                      $('#play4').submit(function(e){
                      e.preventDefault();
                      //laddar in spelaren
                      $("#box4").load( "http://localhost/Herz/public/player.html" );
     //variabler som åker med till php fil för att identifiera spellista
                      var listID4 = $('#listID4').val();
                      var userID4 = $('#userID4').val();

                      $.ajax({
                        // php-filens url
                      url: 'http://localhost/Herz/public/list4.php',
                      //skickar med data
                      data: { listID4: listID4, userID4: userID4},
                      dataType: 'json',
                      success: function(data){            
                      }
                      });
                      });
                    </script>
@endif<!-- slut lista 4 -->

<!-- start lista 5 -->
@if($count > 4)
       <div role="tabpanel" class="tab-pane" id="list5">
<!-- matar ut första spellistan -->
 <a href="http://localhost/Herz/public/playlist/{{ $listID5 }}"> <h1 id="uc-title">{{ $list5->listTitle}}</h1></a>
 <!-- div för spellistacontent -->
  <div id="spelinfobox">
  <h4>Beskrivning av spellistan</h4>
 <hr>
 <p>{{ $list5->listDescription }}</p>
 </div>
 <!-- spellistans meny -->
  <div class="playlistmenu">
  <ul>
        <li>    
        <!-- formulär vars innehåll skickas till php-fil för att generera xml -->             
            <form action="" method="put" name="play5" id="play5">
                <input type="hidden" name="listID5" value="{{ $list5->listID }}" id="listID5">
                <!-- knappen sätter igång js som laddar in listan -->
                  <button type="submit" tooltip="Öppna spellistan" class="knp knp-7 knp-7e knp-icon-only icon-down" id="playOpen5">
                      <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                     </button>
                </form><!-- slut på formulär till xml -->
                   </li>
                   <li>
                   <!-- stänger listan -->
                    <button type="submit" tooltip="Stäng spellistan" class="knp knp-7 knp-7e knp-icon-only icon-up hidden" id="playClose3">
                   </li>    
                   <!-- om användare inloggad -->               
                    @if(Auth::check())
                    <!-- om användare äger spellista -->
                    @if(Auth::user()->userID == $user->userID)                 
                    <li>
                    <!-- formulär för att radera spellistan -->
                     {!!   Form::open(array('method' => 'DELETE', 'route' => array('playlist.destroy', $listID5))) !!}
                    {!! csrf_field() !!}
                 <!-- submit o confirma spellistan ska bort -->
            <button type="submit" tooltip="Ta bort spellistan" class="knp knp-7 knp-7e knp-icon-only icon-delete" onclick="return confirm('Säker på att du vill ta bort spellistan?')">Like</button>
               {!! Form::close() !!}         <!-- slut på delete formulär -->     
                   </li>
                   <li>
                   <!-- knapp som öppnar redigera spellista i nytt fönster -->
                  <button type="button" tooltip="Inställningar" class="knp knp-7 knp-7e knp-icon-only icon-settings" onclick="edit()">Like</button>
                   </li>
                         @endif <!-- slut på auth check -->
                   @endif <!-- slut på koll om användare äger spellista -->
                   <li>
                   <!-- knapp startar script som öppnar spellistan i nytt fönster (och genererar xml) -->
                    <button type="button" tooltip="Extern spellista" class="knp knp-7 knp-7e knp-icon-only icon-bigger" onclick="open5();"></button>
                    </li>
                    <li id="playlist-right">
            
             <!-- facebook dela knapp, tillfälligt inaktiv -->
              <button type="button" onclick="share()" tooltip="Dela på Facebook" class="knp knp-7 knp-7f knp-icon-only fb-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              </li>    
          

         
                   <ul> 
   </div>                 
<!-- en box som spellistan laddas in i senare -->
                    <div id="box5"></div>

</div>
   <script>
          function open5() {
       //öppnar spellistan i externt fönster
var player = window.open("http://localhost/Herz/public/playlistPlayer/mp3_player.swf", "_blank", "titlebar=no,toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=350");
// sätter igång formuläret som genom ajax skickar till php-fil som genererar xml-fil
 $('#play5').trigger('submit');
}
      function edit() {
    //öppnar edit playlists i nytt fönster
window.open("http://localhost/Herz/public/playlist", "_blank", "scrollbars=yes,width=615,height=800");
}
    // om man trycker på öppna spellistan knappen
$('#playOpen5').click(function(){
//lägga till hidden clss o ta bort hidden från stängknappen
$(this).toggleClass('hidden');
$('#playClose5').toggleClass('hidden');
});

$('#playClose5').click(function(){
  //stängknappen tar bort innehåll i boxen och ändrar från hidden
$("#box5").html('');
$(this).toggleClass('hidden');
$('#playOpen5').toggleClass('hidden');
});
//formuläret till xml
                      $('#play5').submit(function(e){
                      e.preventDefault();
                      //laddar in spelaren
                      $("#box5").load( "http://localhost/Herz/public/player.html" );
     //variabler som åker med till php fil för att identifiera spellista
                      var listID5 = $('#listID5').val();
                      var userID5 = $('#userID5').val();

                      $.ajax({
                        // php-filens url
                      url: 'http://localhost/Herz/public/list5.php',
                      //skickar med data
                      data: { listID5: listID5, userID5: userID5},
                      dataType: 'json',
                      success: function(data){            
                      }
                      });
                      });
                    </script>
@endif

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
