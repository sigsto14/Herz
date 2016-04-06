@extends('template')
@section('container')
@section('footer')

@if(Auth::check())
<?php

$user = Auth::user();
/* variabel för senaste uppladdningar */
$senaste = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->orderBy('sounds.created_at', 'DESC')->paginate(6);
/* gör variabel som kollar hur många gånger de förekommer i favorites */
$favorites = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->groupBy('soundID')->orderBy('sounds.created_at', 'DESC')->get();



?>
   
        <title>Herz</title>

            </div>
        </div>

        <div class="container">
          <div class="podcast-box">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#">Senaste</a></li>
            <li role="presentation"><a href="#">Populärt</a></li>
            <li role="presentation"><a href="#">Senast uppladat</a></li>
          </ul>
          <div class="col-md-12" id="container2">
            <h1>Senast uppladdat</h1>
          @foreach($senaste as $senast)

          
          <div class="row">
              <div class="col-md-4" id="podbox"><a href="http://localhost/Herz/public/sound/{{ $senast->soundID }}"><img src="{{ $senast->podpicture }}" width="150px"></a>
              <a href="http://localhost/Herz/public/sound/{{ $senast->soundID }}"><h3>{{ $senast->title }} </h3></a>
              <p>av<a href="http://localhost/Herz/public/channel/{{ $senast->channelID }}">{{ $senast->channelname }}</a></p>
              </div>
           
                        </div>

@endforeach
<h1>Populärt</h1>
@foreach($favorites as $favorite)

<?php

$favNr = DB::table('favorites')->where('soundID', '=', $favorite->soundID)->count();

$popular = DB::table('favorites')->where('soundID', '=', $favorite->soundID)->first();



?>

@if($favNr >= 2)

<div class="col-md-12" id="container2">
          <div class="row">
              <div class="col-md-4" id="podbox"><a href="http://localhost/Herz/public/sound/"><img src="{{ $favorite->podpicture }}" width="150px"></a>
              <a href="http://localhost/Herz/public/sound/"><h3>{{ $favorite->title }}</h3></a>
              <button type="button" class="btn btn-default btn-lg">
              <span class="glyphicon glyphicon-heart" aria-hidden="true"><p>{{$favNr}}</span>
              </button><br><br>
              <p>av <a href="http://localhost/Herz/public/channel/{{ $favorite->channelID}}">{{$favorite->channelname}}</a></p>
              </div>
            
                        </div>

@endif

@endforeach



</div>
</div>

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


    </body>

@stop