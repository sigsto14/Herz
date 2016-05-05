@extends('template')
@section('container')
@section('footer')

@if(Auth::check())
<?php

$user = Auth::user();
/* variabel för senaste uppladdningar */
$senaste = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->orderBy('sounds.created_at', 'DESC')->paginate(6);
$loadMore = $senaste->render();
/* gör variabel som kollar hur många gånger de förekommer i favorites */
$favorites = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->groupBy('soundID')->orderBy('sounds.created_at', 'DESC')->get();
 $favoriteCheck = DB::table('favorites')->first();
$favoriteIDs = DB::table('favorites')->join('sounds', 'sounds.soundID', '=', 'favorites.soundID')->join('channels', 'channels.channelID', '=', 'sounds.channelID')->get();

             $userID = Auth::user()->userID;
             $subscribe = DB::table('subscribe')->join('channels', 'subscribe.channelID', '=', 'channels.channelID')->join('sounds', 'sounds.channelID', '=', 'subscribe.channelID')->where('subscribe.userID', '=', $userID)->orderBy('sounds.created_at', 'ASC')->take(12)->get();


             

?>
<title>Herz</title>       
  <div class="container">
    <div class="col-md-12">
      <div class="podcast-box">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">Senaste</a></li>
          <li role="presentation"><a href="#pop" role="tab" data-toggle="tab">Populärt</a></li>
          <li role="presentation"><a href="#sen" role="tab" data-toggle="tab">Rekommendationer</a></li>
          <li role="presentation"><a href="#pre" role="tab" data-toggle="tab">Prenumerationer</a></li>
        </ul>
        <div class="col-md-9" id="container2">
        <script>
          $('#btnReview').click(function(){
          $(".tab-content").removeClass("active");
          $(".tab-content:first-child").addClass("active");
          });
        </script>          
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">    
            <h1 id="home-title">Senast uppladdat</h1><!-- detta är den aktiva, första som syns --><br>

          @foreach($senaste as $senast) 
          <!-- php kod för att kolla om användare e prenumerant på aktuell kanal -->
          <?php
          $sub = DB::table('subscribe')->where('userID', '=', $userID)->where('channelID', '=', $senast->channelID)->count();
          ?>
          <!-- klipp skall bara synas om de inte är privata -->
          @if($senast->status != 'privat' or $sub > 0)
          <?php
          /* kolla hur många som har klippet som favorit */
          $favNr = DB::table('favorites')->where('soundID', '=', $senast->soundID)->count();
          ?>         
           <div class="col-md-4" id="indexBox">
            
              <a href="http://localhost/Herz/public/sound/{{ $senast->soundID }}"><img src="{{ $senast->podpicture }}" width="150px" height="150px" id="pod-mini-img"></a>
              <div class="podtitle-box">
              <a href="http://localhost/Herz/public/sound/{{ $senast->soundID }}"><h4>{{ $senast->title }} </h4></a>
              <div class="podtitledownbox">
              <div class="podfavicon">
                <div class="vertical-line"></div>
                @if(Auth::check())
              @if($senast->channelID == Auth::user()->userID)
              
<p><span class="glyphicon glyphicon-star"></span>{{ $favNr }}</p>
@else
              <p><span class="glyphicon glyphicon-heart"></span>{{ $favNr }}</p>
              
              @endif
              @endif
              </div>
              <div class="podchanneltitle">
              <p>av <a href="http://localhost/Herz/public/channel/{{ $senast->channelID }}">{{ $senast->channelname }}</a></p>

               </div>       
       </div> 
       </div> 
       </div>        @endif 


@endforeach
<div class="SeeMore">
<?php echo $loadMore

?> 
</div>

            </div>
<!-- här tar första boxen slut -->
<div role="tabpanel" class="tab-pane" id="pop">
    <h1 id="home-title">Populärt</h1><!-- här börjar andra rubriken -->
    @foreach($favorites as $favorite)
      <!-- php kod för att kolla om användare e prenumerant på aktuell kanal -->
          <?php
          $sub = DB::table('subscribe')->where('userID', '=', $userID)->where('channelID', '=', $favorite->channelID)->count();
        /* hämtar ut hur många som har gjort klippet till favorit */

$favNr = DB::table('favorites')->where('soundID', '=', $favorite->soundID)->count();

$popular = DB::table('favorites')->where('soundID', '=', $favorite->soundID)->first();



?>
    <!-- klipp skall bara synas om de inte är privata -->
@if($favNr >= 2)
@if($favorite->status != 'privat' or $sub > 0)

             <div class="col-md-4" id="indexBox">
              <a href="http://localhost/Herz/public/sound/"><img src="{{ $favorite->podpicture }}" width="150px" height="150px" id="pod-mini-img"></a>
              <div class="podtitle-box">
              <a href="http://localhost/Herz/public/sound/"><h4>{{ $favorite->title }}</h4></a>
                          <div class="podtitledownbox">
              <div class="podfavicon">
                <div class="vertical-line"></div>
              @if(Auth::check())
              @if($favorite->channelID == Auth::user()->userID)
<p><span class="glyphicon glyphicon-star">{{ $favNr }}</span></p>
@else

              <p><span class="glyphicon glyphicon-heart">{{ $favNr }}</span></p>
              @endif
              @endif
              </div>
              <div class="podchanneltitle">
              <p>av </p><a href="http://localhost/Herz/public/channel/{{ $favorite->channelID}}">{{$favorite->channelname}}</a>
                      </div>       
       </div> 
       </div>
            
                        </div>

     @endif
@endif
@endforeach

<!-- här slutar andra -->

</div>
<!-- denna ska vara i rubrik 3 -->
<div role="tabpanel" class="tab-pane" id="sen">
  <h1 id="home-title">Rekommendationer</h1><br>
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
         $results = DB::table('channels')->join('sounds', 'sounds.channelID', '=', 'channels.channelID')->where('sounds.soundID', '!=', $soundID)->where('sounds.channelID', '!=', $userID)
         ->where(function($query) use($tag) {
             $query ->where('sounds.tag', 'LIKE', '%' . $tag . '%')
         ->orWhere('sounds.title', 'LIKE', '%' . $tag . '%');
         })->orderBy('sounds.created_at', 'ASC')->take(5)->get();
         ?>

@endforeach


  @foreach($results as $result)

   <!-- php kod för att kolla om användare e prenumerant på aktuell kanal -->
          <?php
    
          $sub = DB::table('subscribe')->where('userID', '=', $userID)->where('channelID', '=', $result->channelID)->count();
          ?>
      <!-- klipp skall bara synas om de inte är privata -->
@if($result->status != 'privat' or $sub > 0)
   <div class="col-md-4" id="indexBox">
         

              <?php

              $favNr = DB::table('favorites')->where('soundID', '=', $result->soundID)->count();
              ?>
               <img src="{{ $result->podpicture }}" width="150px" height="150px" id="pod-mini-img"/>
               <div class="podtitle-box">
               <a href="http://localhost/Herz/public/sound/{{$result->soundID}}"><h4>{{ $result->title }}</h4></a>
                             <div class="podtitledownbox">
              <div class="podfavicon">
                <div class="vertical-line"></div>
            @if(Auth::check())
              @if($result->channelID == Auth::user()->userID)
<p><span class="glyphicon glyphicon-star">{{ $favNr }}</span></p>
@else
              <p><span class="glyphicon glyphicon-heart">{{ $favNr }}</span></p>
              @endif
              @endif
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
 


</div>


<!-- rubrik 4-->
<div role="tabpanel" class="tab-pane" id="pre">
  <h1 id="home-title">Prenumerationer</h1><br>
@foreach($subscribe as $sub)
<?php

              $favNr = DB::table('favorites')->where('soundID', '=', $sub->soundID)->count();
              ?>
 <div class="col-md-4" id="indexBox">
              
               <a href="http://localhost/Herz/public/sound/{{$sub->soundID}}"><img src="{{ $sub->podpicture }}" width="150px" height="150px" id="pod-mini-img"/></a>
               <div class="podtitle-box">
               <a href="http://localhost/Herz/public/sound/{{$sub->soundID}}"><h4>{{ $sub->title }}</h4></a>
                      <div class="podtitledownbox">
              <div class="podfavicon">
                <div class="vertical-line"></div>
                 @if(Auth::check())
              @if($sub->channelID == Auth::user()->userID)
<p><span class="glyphicon glyphicon-star">{{ $favNr }}</span></p>
@else
              <p><span class="glyphicon glyphicon-heart">{{ $favNr }}</span></p>
              @endif
              @endif
              </div>
              <div class="podchanneltitle">
 <p>av <a href="http://localhost/Herz/public/channel/{{ $sub->channelID }}">{{$sub->channelname}}</a></p>
                      </div>       
       </div> 
       </div> 
       </div>


@endforeach



@endif

    </div>
    </div>
    </div>
    <div class="col-md-3" id="darkerbox">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default" id="panel1">
              <div class="panel-heading">
            <h4 class="panel-title">
             <?php
             $userID = Auth::user()->userID;
             $subscribes = DB::table('subscribe')->join('channels', 'subscribe.channelID', '=', 'channels.channelID')->join('sounds', 'sounds.channelID', '=', 'subscribe.channelID')->where('subscribe.userID', '=', $userID)->orderBy('sounds.created_at', 'ASC')->take(5)->get();
             ?>
              <a data-toggle="collapse" data-target="#collapseOne" href="#collapseOne">Prenumerationer</a>
            </h4>
        </div>

        <div id="collapseOne" class="panel-collapse collapse in">
          <div class="panel-body" id="pre-fav">
            <table>
              <p style="margin-left: -10%;">Senaste uppladdningar:</p>
              @foreach($subscribes as $subscribe)
              <tr>
              
               
            <td ><a href="http://localhost/Herz/public/sound/{{ $subscribe->soundID }}" style="margin-left: 18px;">{{ $subscribe->title }}</a></td>
            <td>av</td>
            <td><a href="http://localhost/Herz/public/channel/{{ $subscribe->channelID }}">{{ $subscribe->channelname}}</a></td>
            @endforeach 
            </tr>
                       
          </table> 
          <p style="margin-top: 5%;"><a href="http://localhost/Herz/public/subscribe">Se alla...</a></p>
        </div>
      </div>
      </div>


    <div class="panel panel-default" id="panel1">
        <div class="panel-heading">
             <h4 class="panel-title">
             <!-- skapar variabler för att ta ut favoriter ur databasen -->
             <?php
             $userID = Auth::user()->userID;
             $favorites = DB::table('favorites')->join('sounds', 'favorites.soundID', '=', 'sounds.soundID')->join('channels', 'channels.channelID', '=','sounds.channelID')->where('favorites.userID', '=', $userID)->take(5)->get();
             ?>
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

    </body>

@stop