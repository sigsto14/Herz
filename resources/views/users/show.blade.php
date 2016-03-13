@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>

<title>{{ $user->username }}</title>
>
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
          @if(Auth::user())
            @if(Auth::user()->userID == $user->userID)
            <a href="{{URL::route('user.edit', array('id' => $user->userID)) }}">Ändra kontouppgifter</a><br>
            @endif
            @endif
          </div>
        </div>
        <div class="col-lg-8"id="tabus">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#">Sparade podcasts</a></li>
            <li role="presentation"><a href="#">Favoriter</a></li>
            <li role="presentation"><a href="#">Markerad lista</a></li>
            <li role="presentation"><a href="#">+</a></li>
          </ul>
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
      </div>
      </div>
      </div>

          
     

			




@stop
