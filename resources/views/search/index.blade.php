@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<title>Sökresultat</title>
<div class="container" id="container">
 <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#klipp" role="tab" data-toggle="tab">Klipp</a></li>
            <li role="presentation"><a href="#kanal" role="tab" data-toggle="tab">Kanaler</a></li>
            <li role="presentation"><a href="#anvandare" role="tab" data-toggle="tab">Användare</a></li>
 </ul>
<div class="tab-content">
      <script>
$('#btnReview').click(function(){
  $(".tab-content").removeClass("active");
  $(".tab-content:first-child").addClass("active");
});
</script>

<span class="glyphicon glyphicon-search"></span><p>Du sökte "{{ $query }}"</p>
<!-- kollar om sökningen hittat något klipp -->
<!-- box för klipp -->

            <div role="tabpanel" class="tab-pane active" id="klipp">
<h1 id="uc-title">Klipp</h1>
@if (count($sounds) === 0 || $query == '')
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
    @endif
<div class="row" id="scroll">
<div class="col-md-3" id="uc-box">  
     
    <a><image src="{{ $sound->podpicture }}"width="150px" height="150" id="pod-mini-img"></image><a>
    <div class="podtitle-box">
    <a href="http://localhost/Herz/public/sound/{{ $sound->soundID }}"><h4>{{ $sound->title}}</h4></a>
<!-- gör en liten variabel för att få ut categoryname -->
               <div class="podtitledownbox">
              <div class="podfavicon2">
                <div class="vertical-line2"></div>
                <p><a href="http://localhost/Herz/public/category/{{ $sound->categoryID }}">{{ $sound->categoryname }}</a></p>
                </div>
              <div class="podchanneltitle">
                <a href="http://localhost/Herz/public/channel/{{ $sound->channelID }}">{{ $sound->channelname }}</a>
              </div>
  </div>
  </div>

  </div>

  </div>
          @endforeach



@endif

</div>

<!-- box för kanaler -->
  <div role="tabpanel" class="tab-pane" id="kanal">
<h1>Kanaler</h1>
<!-- kollar om sökningen hittat några kanaler -->
@if (count($channels) === 0 || $query == '')
Inga kanaler matchar din sökning
<!-- om det finns kanaler visar dom -->
@else

    @foreach($channels as $channel)

<?php

/* kolla när senaste aktiviteten var och hur många klipp */
$sound = DB::table('sounds')->where('channelID', '=', $channel->channelID)->orderBy('created_at', 'ASC')->first();
$soundCount = DB::table('sounds')->where('channelID', '=', $channel->channelID)->count();

?>
@if(is_null($sound))
@else
   <a href="http://localhost/Herz/public/channel/{{ $channel->channelID }}"><h1>{{ $channel->channelname }}</h1></a>
  


<p>Kanal skapad {{ $channel->created_at }}<br>
Antal uppladdningar: {{ $soundCount }}<br>
<h3>Senaste:</h3><br>
     <a href="http://localhost/Herz/public/sound/{{ $sound->soundID }}"><image src="{{ $sound->podpicture }}" width="20px" height="auto"></image><h4>{{ $sound->title}}</h4></a>


</p>
  @endif

    @endforeach
  
 @endif   
  </div>
<!-- eftersom det av nån anledning inte gick att definiera en variabel för users i querycontroller görs det här istället -->
<?php
$users = DB::table('users')->where('username', 'LIKE', '%' . $query . '%')->take(5)->get();

?>
   <div role="tabpanel" class="tab-pane" id="anvandare">
<h1>Användare</h1>
@if (count($users) === 0 || $query == '')
Inga användare matchar din sökning
@else
@foreach($users as $user)
<h2>Sökresultat</h2>
   <a href="http://localhost/Herz/public/user/{{ $user->userID }}"><img src="{{ $user->profilePicture }}" width="30px" height="auto"></a><a href="http://localhost/Herz/public/user/{{ $user->userID }}"><h4>{{ $user->username }}</h4></a>
   <h6>Medlem sedan: {{ $user->created_at }}</h6>

@endforeach

  
    
@endif
  </div>
    
<!-- kollar om hittat några users -->

</div>
    </div>

@stop