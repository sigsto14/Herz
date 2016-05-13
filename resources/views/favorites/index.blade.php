@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>
  <div class="container">
  <div class="col-md-12" id="container4">

 @if(Auth::user())

<?php
$favorites1 = DB::table('favorites')->join('sounds', 'favorites.soundID', '=', 'sounds.soundID')->join('users', 'users.userID', '=', 'favorites.userID')->get();
$userID = Auth::user()->userID;
/* gör en variabel för att hämta ut alla favoriter användaren har **/
$favorites = DB::table('favorites')->where('favorites.userID', '=', $userID)->join('sounds', 'favorites.soundID', '=', 'sounds.soundID')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->get();
?>

<body>
@yield('content')
<br>

   <h1 id="uc-title">{{ Auth::user()->username }}'s favoriter</h1>
   <!-- lägger ut resultaten en och en -->

    
              <div class="row">
              @foreach($favorites as $favorite)
 <div class="col-md-3" id="uc-box">          
               <a href="http://localhost/Herz/public/sound/{{ $favorite->soundID }}"><image src="{{ $favorite->podpicture }}" width="150px" height="150" id="pod-mini-img"></a>
               <div class="podtitle-box">
               <a href="http://localhost/Herz/public/sound/{{ $favorite->soundID }}"><h4>{{ $favorite->title }}</h4></a>
               <div class="podtitledownbox">
              <div class="podfavicon2">
                <div class="vertical-line2"></div>
                 <button class="button"><span class="icon-heart4"></span></button>
                </div>     
            <div class="podchanneltitle">
              
              <p style="margin-left: 6%; margin-top: -5%;">av <a href="http://localhost/Herz/public/channel/{{ $favorite->channelID }}">{{ $favorite->channelname}}</a></p>
              </div>
              </div>
              </div> 
              </div>

         @endforeach
     </div>
     </div>
     </div>
     </image>
   
		@endif	


</div>
</div>
</div>
</body>
@stop