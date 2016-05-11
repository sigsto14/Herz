@extends('template')
@section('container')
@section('footer')

@if(Auth::check())
<?php
//lite förenklande variabler med inloggad användare
$user = Auth::user();
$userID = Auth::user()->userID;

/* variabel för senaste uppladdningar */
$senaste = DB::table('sounds')
 ->join('channels', 'sounds.channelID', '=', 'channels.channelID')
 ->orderBy('sounds.created_at', 'DESC')
 ->simplePaginate(6);

//variabel för paginate för senaste
$loadMore = $senaste->render();

// variabel för att kunna kolla om favorites är null
$favoriteCheck = DB::table('favorites')->first();

//hämtar favoriter
$favoriteIDs = DB::table('favorites')
 ->join('sounds', 'sounds.soundID', '=', 'favorites.soundID')
 ->join('channels', 'channels.channelID', '=', 'sounds.channelID')
 ->get();

//hämtar soundID från favorites och sorterar dem efter hur många gånger de förekommer i tabellen
$popularCheck = DB::table('favorites')
  ->selectRaw('soundID, COUNT(*) as count')
  ->groupBy('soundID')
  ->orderBy('count', 'desc')
  ->take(12)->get();

//hämtar ut inloggad användares prenumerationer, information kring det och sortera genom 5 senaste uppladdningar. 
$subscribes = DB::table('subscribe')
 ->join('channels', 'subscribe.channelID', '=', 'channels.channelID')
 ->join('sounds', 'sounds.channelID', '=', 'subscribe.channelID')
 ->where('subscribe.userID', '=', $userID)
 ->orderBy('sounds.created_at', 'ASC')
 ->take(5)
 ->get();

//hämtar ut inloggad användares prenumerationer, information kring det och sortera genom 5 senaste uppladdningar.
$favorites = DB::table('favorites')
 ->join('sounds', 'favorites.soundID', '=', 'sounds.soundID')
 ->join('channels', 'channels.channelID', '=','sounds.channelID')
 ->where('favorites.userID', '=', $userID)
 ->take(5)
 ->get();       

?>
<title>Herz</title>       
  <div class="container">
    <div class="col-md-12">
      <div class="podcast-box">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">Senaste</a></li>
          <li role="presentation"><a href="#pop" role="tab" data-toggle="tab">Populärt</a></li>
          <li role="presentation"><a href="#sen" role="tab" data-toggle="tab">Rekommendationer</a></li>
        </ul> 

            <div class="col-md-9" id="container2">
            <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">    
<h1 id="home-title">Senast uppladdat</h1><!-- detta är den aktiva, första som syns --><br>

<!-- loop för resultat av senaste uppladdningar, hämtar ut resultat individuellt (gör även ny php kod med de individuella idna osv) -->
@foreach($senaste as $senast) 
<?php
/* php kod för att kolla om användare e prenumerant på aktuell kanal*/
$sub = DB::table('subscribe')->where('userID', '=', $userID)->where('channelID', '=', $senast->channelID)->count();
/* kolla hur många som har klippet som favorit */
$favNr = DB::table('favorites')->where('soundID', '=', $senast->soundID)->count();
// variabel av kanalnamn och podtitel
$channelname = $senast->channelname;
$title = $senast->title;
//kollar längden på kanalnamn och podtitel
$cnlen = strlen($channelname);
$tlen = strlen($title);
//kortar ner för långa kanalnamn och podtitlar
if($cnlen > 10){
$channelnameCut = substr($channelname, 0, 7);
$channelname = $channelnameCut . '...';
}
if($tlen > 15){
$titleCut = substr($title, 0, 12);
$title = $titleCut . '...';
}
?>
<!-- klipp skall bara synas om de inte är privata/kollar så att det INTE är satt på privat, och/eller om man är prenumerant på kanalen -->
@if($senast->status != 'privat' or $sub > 0)
<!-- matar ut information om var klipp individuellt -->
              <div class="col-md-4" id="indexBox">
              <a href="http://localhost/Herz/public/sound/{{ $senast->soundID }}"><img src="{{ $senast->podpicture }}" width="150px" height="150px" id="pod-mini-img"></a>
              <div class="podtitle-box">
              <a href="http://localhost/Herz/public/sound/{{ $senast->soundID }}"><h4>{{ $title }} </h4></a>
              <div class="podtitledownbox">
              <div class="podfavicon">
              <div class="vertical-line"></div>

<!-- kollar om inloggad användare äger kanalen klippet är på -->
@if($senast->channelID == Auth::user()->userID)     
<!-- stjärna för att markera att det är "ditt" klipp -->      
              <p><span class="glyphicon glyphicon-star"></span>{{ $favNr }}</p>
<!-- om det inte är inloggad användarens klipp -->
@else
<!-- visar hur många favoritmarkeringar ett klipp har -->
              <p><span class="glyphicon glyphicon-heart"></span>{{ $favNr }}</p>
@endif
<!-- slut på om användare äger kanal -->


        </div>
        <div class="podchanneltitle">

<p>av <a class="linkHover" tooltip="{{ $senast->channelname }}" href="http://localhost/Herz/public/channel/{{ $senast->channelID }}">{{ $channelname }}</a></p>

       </div>       
       </div> 
       </div> 
       </div>        
@endif <!-- slut på koll så klipp ej är privat -->
@endforeach <!-- slut på loop för senaste klipp -->

<div class="SeeMore">
<!-- matar ut paginate-meny med loadmorevariabel -->
<center><?php echo $loadMore; ?></center>
</div>
</div>


<!-- här tar första boxen slut -->
<div role="tabpanel" class="tab-pane" id="pop">

<h1 id="home-title">Populärt</h1><!-- här börjar andra rubriken -->
<!-- loop för popularcheck, hämtar ut resultaten individuellt -->
@foreach($popularCheck as $pop)
<?php
/* hämtar ut hur många som har gjort klippet till favorit (nr) */
$favNr = DB::table('favorites')->where('soundID', '=', $pop->soundID)->count();
//hämtar ut populära poddar med variabeln som sroterade efter favoritmarkeringar
$popular = DB::table('sounds')->join('channels', 'sounds.channelID','=', 'channels.channelID')->where('soundID', '=', $pop->soundID)->first();

?>
<!-- klipp skall bara synas om de inte är privata -->
@if($popular->status != 'privat' or $sub > 0)
<br>
              <div class="col-md-4" id="indexBox">
              <a href="http://localhost/Herz/public/sound/"><img src="{{ $popular->podpicture }}" width="150px" height="150px" id="pod-mini-img"></a>
              <div class="podtitle-box">
              <a href="http://localhost/Herz/public/sound/"><h4>{{ $popular->title }}</h4></a>
              <div class="podtitledownbox">
              <div class="podfavicon">
                <div class="vertical-line"></div>
<!-- kollar om någon inloggad -->

<!-- kollar om inloggad användare är kanalägare och matar ut stjärna vid klipp -->
@if($popular->channelID == Auth::user()->userID)
<p><span class="glyphicon glyphicon-star">{{ $favNr }}</span></p>
<!-- om ej inloggad äger kanal -->
@else
<p><span class="glyphicon glyphicon-heart">{{ $favNr }}</span></p>
<!-- slut koll om inloggad användare äger kanal -->
@endif

</div>
   <div class="podchanneltitle">
              <p>av <a href="http://localhost/Herz/public/channel/{{ $popular->channelID}}">{{$popular->channelname}}</a></p>
   </div>       
       </div> 
       </div>
       </div>

<!-- slut på koll om pod privat -->  
@endif
<!-- slut på popular for loop -->
@endforeach

<!-- här slutar andra rubriken -->

</div>
<!-- rubrik 3 -->
<div role="tabpanel" class="tab-pane" id="sen">
  <h1 id="home-title">Rekommendationer</h1><br>
<!-- kollar så användaren har favoriter -->
<!-- om ej favoriter-->
@if(is_null($favoriteCheck))
           <p>Inga rekommendationer</p>
@else
<!-- om favoriter finns gör loop av favoriteIDs -->
@foreach($favoriteIDs as $favoriteID)

 <?php
/* fixar lite variabler så vi kan testa mot dem */
$soundID = $favoriteID->soundID;
$tag = $favoriteID->tag;
/* hämtar ut från channels och sounds som INTE finns i favorites redan för användaren */
/* gör en query för att "or where" inte ska krocka med where */
/* variablen hämtar ut ljudklipp där titel eller tagg liknar de som användaren har i sina favoriter */
         $results = DB::table('channels')
         ->join('sounds', 'sounds.channelID', '=', 'channels.channelID')
         ->where('sounds.soundID', '!=', $soundID)
         ->where('sounds.channelID', '!=', $userID)
         ->where(function($query) use($tag) {
             $query ->where('sounds.tag', 'LIKE', '%' . $tag . '%')
         ->orWhere('sounds.title', 'LIKE', '%' . $tag . '%');
         })
         ->orderBy('sounds.created_at', 'ASC')
         ->take(5)
         ->get();
         ?>

<!-- slut på favoriteIDs loop -->
@endforeach
<!-- gör nu loop på resultaten -->
@foreach($results as $result)
      <!-- klipp skall bara synas om de inte är privata -->
@if($result->status != 'privat' or $sub > 0)
   <div class="col-md-4" id="indexBox">
         
<?php
// kollar hur många favoritmarkeringar en pod har med hjälp av resultvariabeln
$favNr = DB::table('favorites')->where('soundID', '=', $result->soundID)->count();
?>
<!-- matar ut resultat -->
               <img src="{{ $result->podpicture }}" width="150px" height="150px" id="pod-mini-img"/>
               <div class="podtitle-box">
               <a href="http://localhost/Herz/public/sound/{{$result->soundID}}"><h4>{{ $result->title }}</h4></a>
                             <div class="podtitledownbox">
               <div class="podfavicon">
                <div class="vertical-line"></div>

<!-- om inloggad användare äger kanal -->
@if($result->channelID == Auth::user()->userID)
<p><span class="glyphicon glyphicon-star">{{ $favNr }}</span></p>
@else
<!-- om inloggad användare ej äger kanal -->
<p><span class="glyphicon glyphicon-heart">{{ $favNr }}</span></p>
<!-- slut på koll om användare äger kanal-->
@endif

              </div>
              <div class="podchanneltitle">
 <p>av <a href="http://localhost/Herz/public/channel/{{ $result->channelID }}">{{$result->channelname}}</a></p>

        </div>       
       </div> 
       </div>              
        </div>
<!-- slut på koll så klipp ej är privat -->
@endif
<!-- slut på result for loop -->
@endforeach
<!-- slut på koll om favorites är är null eller ej -->
@endif
 


</div>

<!-- om användare inloggad -->


    </div>
    </div>
<!-- start sidebox -->
    <div class="col-md-3" id="darkerbox">
          <div class="panel-group" id="accordion">
      <div class="panel panel-default" id="panel1">
              <div class="panel-heading">
            <h4 class="panel-title">
                  <a data-toggle="collapse" data-target="#collapseOne" href="#collapseOne">Prenumerationer</a>
            </h4>
              </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body" id="pre-fav">
            <table>
              <p style="margin-left: -10%;">Senaste uppladdningar:</p>
<!-- loop för subscribes resultat, matar ut resultat enskilt -->
@foreach($subscribes as $subscribe)
              <tr>
              
               
            <td><a href="http://localhost/Herz/public/sound/{{ $subscribe->soundID }}" style="margin-left: 18px;">{{ $subscribe->title }}</a></td>
            <td>av</td>
            <td><a href="http://localhost/Herz/public/channel/{{ $subscribe->channelID }}">{{ $subscribe->channelname}}</a></td>
@endforeach
<!-- subscribeloop slut -->
              </tr>
            </table> 
          <p style="margin-top: 5%;"><a href="http://localhost/Herz/public/subscribe">Se alla...</a></p>
        </div>
      </div>
    </div>


<div class="panel panel-default" id="panel1">
<div class="panel-heading">
         <h4 class="panel-title">
    <a data-toggle="collapse" data-target="#collapseTwo" href="#collapseTwo">Favoriter</a>
         </h4>
</div>
        
        <div id="collapseTwo" class="panel-collapse collapse in">
            <div class="panel-body" id="pre-fav">
          <table >
          <p style="margin-left: -10%;">Senaste favoriter:</p>
          <tr>
<!-- tar varje resultat (5 st) individuellt -->
@foreach($favorites as $favorite)  
            <td><a href="http://localhost/Herz/public/sound/{{ $favorite->soundID }}" style="margin-left: 18px;">{{ $favorite->title }}</a></td>
            <td>Kanal:</td>
            <td ><a href="http://localhost/Herz/public/channel/{{ $favorite->channelID }}">{{ $favorite->channelname}}</a></td></tr>
<!-- slut favorites for loop -->
@endforeach
            </tr>
           </table>
           <p style="margin-top: 5%;"><a href="http://localhost/Herz/public/favorite">Se alla...</a></p>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
    </div>

    </div>
    </div> 
    </div>
<!-- slut på auth check -->
@endif

    </body>


@stop