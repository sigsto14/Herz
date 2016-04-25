@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<title>Sökresultat</title>
<div class="container" id="container">
 <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#klipp" role="tab" data-toggle="tab">Klipp</a></li>
            <li role="presentation"><a href="#kanal" role="tab" data-toggle="tab">Kanaler</a></li>
            <li role="presentation"><a href="#users" role="tab" data-toggle="tab">Användare</a></li>
 </ul>

      <script>
$('#btnReview').click(function(){
  $(".tab-content").removeClass("active");
  $(".tab-content:first-child").addClass("active");
});
</script>
<div class="tab-content">
<span class="glyphicon glyphicon-search"><p>Du sökte "{{ $query }}"</p></span>
<!-- kollar om sökningen hittat något klipp -->
<!-- box för klipp -->

            <div role="tabpanel" class="tab-pane active" id="klipp">
<h1>Klipp</h1>
@if (count($sounds) === 0)
Inga klipp matchar din sökning
Kolla igenom <a href="http://localhost/Herz/public/sound">senaste uppladdningar!</a>
@else

  @foreach($sounds as $sound)
  <?php
  if(Auth::check()){
    // sätter variabel för inloggad user
$userID = Auth::user()->userID;

  }
  else {
    $userID = '';
  }
  // kollar om inloggad user subbar på aktuellt klipp
  $sub = DB::table('subscribe')->where('userID', '=', $userID)->where('channelID', '=', $sound->channelID)->count();
  ?>
@if($sound->status != 'privat' or $sub > 0)
     <a href="http://localhost/Herz/public/sound/{{ $sound->soundID }}"><h1>{{ $sound->title}}</h1></a>
    <image src="{{ $sound->podpicture }}" width="80px" height="auto"></image>
    <audio controls>
  <source src="{{ $sound->URL }}" type="audio/ogg">
  <source src="{{ $sound->URL }}" type="audio/mpeg">
Your browser does not support the audio element.
</audio><br>
<!-- gör en liten variabel för att få ut categoryname -->

<p><a href="http://localhost/Herz/public/category/{{ $sound->categoryID }}">{{ $sound->categoryname }}</a></p>
Uppladdat av <a href="http://localhost/Herz/public/channel/{{ $sound->channelID }}">{{ $sound->channelname }}</a><br><br>
   @endif
    @endforeach
@endif
</div>


<!-- box för kanaler -->
  <div role="tabpanel" class="tab-pane" id="kanal">
<h1>Kanaler</h1>
<!-- kollar om sökningen hittat några kanaler -->
@if (count($channels) === 0)
Inga kanaler matchar din sökning</div>
<!-- om det finns kanaler visar dom -->
@else
<table>
    @foreach($channels as $channel)

<?php

/* kolla när senaste aktiviteten var och hur många klipp */
$sound = DB::table('sounds')->where('channelID', '=', $channel->channelID)->orderBy('created_at', 'ASC')->first();
$soundCount = DB::table('sounds')->where('channelID', '=', $channel->channelID)->count();

?>

   <a href="http://localhost/Herz/public/channel/{{ $channel->channelID }}"><h1>{{ $channel->channelname }}</h1></a>
  


<p>Kanal skapad {{ $channel->created_at }}<br>
Antal uppladdningar: {{ $soundCount }}<br>
<h3>Senaste:</h3><br>
     <a href="http://localhost/Herz/public/sound/{{ $sound->soundID }}"><image src="{{ $sound->podpicture }}" width="20px" height="auto"></image><h4>{{ $sound->title}}</h4></a>


</p>
  

    @endforeach
    </div></div>
 @endif   


    </div>



<!-- kollar om hittat några users -->

</div>
    </div>
    </div>

@stop