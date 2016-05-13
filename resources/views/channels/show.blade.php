@extends('template')
@section('container')
@section('footer')

<?php
/* variabel för se hur många gånger ID förekommer i subscribetabell */
$subscrNr = DB::table('subscribe')->where('channelID', '=', $channel->channelID)->count();
//variabel av aktulle kanals id //channelvariabel kommer från ChannelController show
$channelID = $channel->channelID;
//hämtar kanalens klipp 
$soundsCheck = DB::table('sounds')->where('channelID', '=', $channelID)->first();  
$sounds = DB::table('sounds')->where('channelID', '=', $channelID)->orderBy('sounds.created_at', 'desc')->get();  
//om användare inloggad userID variabel.
if(Auth::check()){  
//variabel av inloggad användare
$userID = Auth::user()->userID;


//kopplingssträng til ldtabas för att kunna jobba mot den med php
$mysqli = new mysqli("localhost","root","","herz");

//kollar om användaren prenumererar på kanalen eller ej
$prenCheckQ = <<<END
SELECT * FROM subscribe
WHERE userID = '{$userID}'
AND channelID = '{$channelID}'
END;
$prenCheckG = $mysqli->query($prenCheckQ);
if($prenCheckG->num_rows >0){
  $pren = 'true';
}
else {
  $pren = 'false';
}


}


?> 
<title>{{ $channel->channelname }}</title>
<body>
@yield('content')
<!-- Kanal innehåll --> 
    <div class="container">
    <div class="col-md-12" id="container">
    <!-- Kanal header --> 
        <div class="channel_header">
        <img src="http://ideweb2.hh.se/~sigsto14/Herz/public/images/channel/default.png">
        </div>
        <!-- Första låda, här finns profil --> 
        <div class="col-lg-4" id="user-box">
          <div class="row">
            <h2>{{ $channel->channelname }}</h2>
            </div>
            <br>
          <div class="row" id="usinfobox">
            <h4>Information om Kanalen</h4>
            <hr>
            <p>{{ $channel->information }}</p> 
          </div>
          <div class="row">          
          </div>
          <div class="row">
          </div>
          <hr>
          <div class="playlistmenu2">
                    <ul>

   <li>       
@if(Auth::check())<!-- om användare inloggad -->
  @if(Auth::user()->userID == $channel->channelID)
           <li>
            <a href="http://ideweb2.hh.se/~sigsto14/Herz/public/index.php/channel/{{ $channel->channelID }}/edit"><button type="submit" tooltip="Redigera kanal" class="knp knp-7 knp-7e knp-icon-only icon-settings" href="{{URL::route('channel.edit', array('id' => $user->userID)) }}">Like</button></a>
            </li>
            @else
               @if($pren == 'false')<!-- om ej prenumererar -->
            <button type="button" id="pren" tooltip="Prenumerera" class="knp knp-7 knp-7e knp-icon-only icon-eye2">Like</button>
            @elseif($pren == 'true') <!-- om prenumererar -->
                  <button type="button" id="pren" tooltip="Sluta prenumerera" class="knp knp-7 knp-7e knp-icon-only icon-eye2b">Like</button>
                  @else 
                  @endif
                    <input type="hidden" name="userID" id="userID" value="{{ $userID }}" >
              <input type="hidden" name="channelID" id="channelID" value="{{ $channelID }}" >
  
                  

        
            @endif<!-- slut koll om man äger kanal -->



            @endif<!-- slut auth check -->
</li>
   <li id="playlist-right2" class="linkHover" tooltip="{{ $channel->channelname }} har {{ $subscrNr }} prenumeranter">
          <p class="icon-pre" >: {{ $subscrNr }}</p> 
          </li>
          </ul>         
          </div>
          <br>
    <form id="act" action="" method="post">
          <!-- input användarnamn -->
          <input type="hidden" id="channelID" value="{{ $channel->channelID }}">
          
          </form>
  <div class="row" id="usinfobox">
          <h4>Senaste aktivitet</h4>
          <hr>
          <ul id="activity">
         </ul>
          </div>
        </div>

          <!-- Andra lådan, här fins podar -->
        <div class="col-lg-8"  id="uc-tabus">        
          <ul class="nav nav-tabs" role="tablist" >
            <li role="presentation" class="active"><a href="#chome" role="tab" data-toggle="tab">{{ $channel->channelname }}</a></li>
            <li role="presentation"><a href="#fav" role="tab" data-toggle="tab">Serier</a></li>
            <li role="presentation"><a href="#list" role="tab" data-toggle="tab">Liknande</a></li>
            <li role="presentation"><a href="#add" role="tab" data-toggle="tab">+</a></li>
          </ul>


          <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" id="container2">
            <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="chome">
<!-- loop för alla klipp -->

<!-- loop för alla klipp -->
@if(is_null($soundsCheck))
@else
@foreach($sounds as $sound)

        <?php
//gör variabel av var enskilt soundID
$soundID = $sound->soundID;
if(Auth::check()){
//query för att inloggad användares favoriter, med soundIDt
$query = <<<END
SELECT * FROM favorites
WHERE userID = '{$userID}'
AND soundID = '{$soundID}'
END;
//sätter states för att avgöra om det är favorit eller ej
$res = $mysqli->query($query);
if($res->num_rows > 0){
  //klippet är favorit
  $state = 2;
}
else {
  //klippet är ej favorit
$state = 3;
}
}
//hämtar ut kategorier
$category = DB::table('category')->where('categoryID', '=', $sound->categoryID)->first();
/* hämtar ut tiden klippet laddades upp */  
$uploaded= substr($sound->created_at, 0, 10);
?>
<!-- ^state 2 om det är favorit och state 3 om ej -->

@if($sound->status != 'privat' or $state == 0 or $channel->channelID == $userID)
<!-- visar upp alla ljud -->
          <div class="col-md-5" id="uc-box">
           <a href="http://ideweb2.hh.se/~sigsto14/Herz/public/index.php/sound/{{ $sound->soundID }}">
           <img src=" {{ $sound->podpicture }}" width="150px" height="150" id="pod-mini-img"></a>
            <div class="podtitle-box">
            <a href="http://ideweb2.hh.se/~sigsto14/Herz/public/index.php/sound/{{ $sound->soundID }}"><h4>{{ $sound->title }}</h4> 
          </a>
          <div class="podtitledownbox">
              <div class="podfavicon">
                <div class="vertical-line3"></div>
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
 

<button class="button"><span class="icon-heart5"></span></button>
{!! Form::close() !!}
<!-- om det redan är favorit kan man ta bort från favorit -->
@else
<td>{!! Form::open(array('method' => 'DELETE', 'route' => array('favorite.destroy', $sound->soundID)))  !!}

<button class="button"><span class="icon-heart4"></span></button>

{!! Form::close() !!}</td>
@endif<!-- slut på om man inte är inloggad användare -->
@endif<!--slut på state-checj -->
<!-- slut på favoriter -->
              </div>
              <div class="podchanneltitle">
              <p>{{ $uploaded }}</p>

               </div>       
       </div> 
           </div>





<!-- kollar om det är den inloggade användarens kanal och då kan användaren ta bort ljudklipp -->
@if(Auth::user()->userID == $user->userID)

{!!   Form::open(array('method' => 'DELETE', 'route' => array('sound.destroy', $sound->soundID))) !!}
{!! csrf_field() !!}
{!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort spellistan?");' )) !!}
{!! Form::close() !!}
@endif<!-- slut på koll om användare äger kanal -->
@endif<!-- slut på koll om det är privat klipp-->
</div>

@endif<!-- slut på auth check -->

@endforeach
 </div>

  <div role="tabpanel" class="tab-pane" id="fav">
  <h1 id="uc-title">Serier</h1>
  <!-- Innehåll här (Serier) -->
  </div>
  <div role="tabpanel" class="tab-pane" id="list">
  <h1 id="uc-title">List</h1>
  <!-- Innehåll här (List) -->
  </div>

  <div role="tabpanel" class="tab-pane" id="add">
  <h1 id="uc-title">Namnlös</h1>
<!-- Innehåll här (plus flik ) -->
  </div>

          </div>


          </div>

          </div>   
          </div>
          
                     
          </div>
          </div>
<!-- /container -->
   
      <!--TADAAA!!-->
      



</body>
@endif



















            <script>
            $(document).ready(function()
{

    $('#pren').click(function()
  {

var userID = $(this).next('#userID').val();
var channelID = $('#channelID').val();
$.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Herz/public/pren.php',
  data: { userID: userID, channelID: channelID},  
        dataType: 'text',

   success: function(data){ 
if(data == 'removed'){
  $('#pren').removeClass('icon-eye2b');
  $('#pren').addClass('icon-eye2');
}
else if(data == 'added'){
  $('#pren').removeClass('icon-eye2');
  $('#pren').addClass('icon-eye2b');
}
  },
   error: function() {}


 });
  });
      });


             $(document).ready(function()
{
  function actTrigger(){
   
$('#act').trigger('submit');

}
    $('#act').submit(function(e)
  {

    e.preventDefault();
var channelID = $('#channelID').val();

$.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Herz/public/activityC.php',
  data: { channelID: channelID},  
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
@stop