@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>

<title>{{ $user->username }}</title>
<br><br><br><br><br><br>
<body>
@yield('content')
<!-- Kanal innehåll --> 
    <div class="container">
    <!-- Kanal header --> 
        <div class="channel_header">
        <img src="http://localhost/Herz/public/images/channel/default.png">
        </div><br>
        <div class="podcast-box_channel">
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
         <!-- Andra lådan, här fins podar -->
        <div class="col-lg-8">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#">Sparade podcasts</a></li>
            <li role="presentation"><a href="#">Favoriter</a></li>
            <li role="presentation"><a href="#">Markerad lista</a></li>
            <li role="presentation"><a href="#">+</a></li>
          </ul>
          <br>
          <div class="row">
          
     

			



</body>
@stop