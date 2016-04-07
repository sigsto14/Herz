@extends('template')
@section('container')
@section('footer')

@if(Auth::check())
<?php

$user = Auth::user();
/* variabel för senaste uppladdningar */
$senaste = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->orderBy('sounds.created_at', 'DESC')->take(6)->get();
/* gör variabel som kollar hur många gånger de förekommer i favorites */
$favorites = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->groupBy('soundID')->orderBy('sounds.created_at', 'DESC')->get();

$favoriteIDs = DB::table('favorites')->join('sounds', 'sounds.soundID', '=', 'favorites.soundID')->join('channels', 'channels.channelID', '=', 'sounds.channelID')->get();

             $userID = Auth::user()->userID;
             $subscribe = DB::table('subscribe')->join('channels', 'subscribe.channelID', '=', 'channels.channelID')->join('sounds', 'sounds.channelID', '=', 'subscribe.channelID')->where('subscribe.userID', '=', $userID)->orderBy('sounds.created_at', 'ASC')->take(12)->get();
             

?>

        <title>Herz</title>

       
        <div class="container">

          <div class="podcast-box">

          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">Senaste</a></li>
            <li role="presentation"><a href="#pop" role="tab" data-toggle="tab">Populärt</a></li>
            <li role="presentation"><a href="#sen" role="tab" data-toggle="tab">Rekommendationer</a></li>
            <li role="presentation"><a href="#pre" role="tab" data-toggle="tab">Prenumerationer</a></li>
          </ul>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="container2">
          <script>
$('#btnReview').click(function(){
  $(".tab-content").removeClass("active");
  $(".tab-content:first-child").addClass("active");
});
</script>
          
            <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
            <h1>Senast uppladdat</h1> <!-- detta är den aktiva, första som syns --><br>
          @foreach($senaste as $senast) 
          <?php
          /* kolla hur många som har klippet som favorit */
          $favNr = DB::table('favorites')->where('soundID', '=', $senast->soundID)->count();
          ?>         
           <div class="col-md-3 col-sm-4 col-xs-3 col-lg-4" id="indexBox">
            <a href="http://localhost/Herz/public/sound/{{ $senast->soundID }}"><h3>{{ $senast->title }} </h3></a>
              <a href="http://localhost/Herz/public/sound/{{ $senast->soundID }}"><img src="{{ $senast->podpicture }}" width="180px" height="120px"></a><br><br>
              <p><span class="glyphicon glyphicon-heart">{{ $favNr }}</span></p>
              <p>av<a href="http://localhost/Herz/public/channel/{{ $senast->channelID }}">{{ $senast->channelname }}</a></p>
                      
            </div>       
@endforeach
<a href="http://localhost/Herz/public/sound" id="SeeMore">Se fler...</a>
            </div>
<!-- här tar första boxen slut -->
<div role="tabpanel" class="tab-pane" id="pop">
    <h1>Populärt</h1><!-- här börjar andra rubriken -->
    @foreach($favorites as $favorite)

<?php

$favNr = DB::table('favorites')->where('soundID', '=', $favorite->soundID)->count();

$popular = DB::table('favorites')->where('soundID', '=', $favorite->soundID)->first();



?>

@if($favNr >= 2)


             <div class="col-md-3 col-sm-4 col-xs-3 col-lg-4" id="indexBox">
              <a href="http://localhost/Herz/public/sound/"><img src="{{ $favorite->podpicture }}" width="150px" heigh="120px"></a>
              <a href="http://localhost/Herz/public/sound/"><h3>{{ $favorite->title }}</h3></a>
              <p><span class="glyphicon glyphicon-heart">{{ $favNr }}</span></p>
              <p>Kanal </p><a href="http://localhost/Herz/public/channel/{{ $favorite->channelID}}">{{$favorite->channelname}}</a>
             
            
                        </div>

@endif

@endforeach

<!-- här slutar andra -->

</div>
<!-- denna ska vara i rubrik 3 -->
<div role="tabpanel" class="tab-pane" id="sen">
  <h1>Rekommendationer</h1>
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
         })->orderBy('sounds.created_at', 'ASC')->paginate(5);
       
         ?>


  @foreach($results as $result) <div class="col-md-3 col-sm-4 col-xs-3 col-lg-4" id="indexBox">
              <?php

              $favNr = DB::table('favorites')->where('soundID', '=', $result->soundID)->count();
              ?>
               <img src="{{ $result->podpicture }}" style="width:150px;height:120px;"/><br>
               <h3><a href="http://localhost/Herz/public/sound/{{$result->soundID}}">{{ $result->title }}</a></h3><br>
                <p><span class="glyphicon glyphicon-heart">{{ $favNr}}</span></p>
 <p>Kanal <a href="http://localhost/Herz/public/channel/{{ $result->channelID }}">{{$result->channelname}}</a></p>
              
              
             </div>

             @endforeach
             @endforeach
</div>

<!-- rubrik 4-->
<div role="tabpanel" class="tab-pane" id="pre">
  <h1>Prenumerationer</h1>
@foreach($subscribe as $sub)
<?php

              $favNr = DB::table('favorites')->where('soundID', '=', $sub->soundID)->count();
              ?>
 <div class="col-md-3 col-sm-4 col-xs-3 col-lg-4" id="indexBox">
              
               <a href="http://localhost/Herz/public/sound/{{$sub->soundID}}"><img src="{{ $sub->podpicture }}" style="width:150px;height:120px;"/></a><br>
               <h3><a href="http://localhost/Herz/public/sound/{{$sub->soundID}}">{{ $sub->title }}</a></h3><br>
                <span class="glyphicon glyphicon-heart">{{ $favNr}}</span>
 <p>Kanal <a href="http://localhost/Herz/public/channel/{{ $sub->channelID }}">{{$sub->channelname}}</a></p>
              
              
             </div>
@endforeach



@endif
          <!--
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
          </div> 
         </div>  
        </div>-->
    </div>
    </div>
    </div>
    </div> 
    </div>

    </body>

@stop