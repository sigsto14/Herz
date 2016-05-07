<!DOCTYPE html>


<html lang="sv">
  <head>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="En svensk podcast plattform">
    
    <meta name="author" content="Herz">
   <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">



@if(Auth::check())
 <div id="noti" class="hidden">
         <?php
            /* först hämta ut userID och last_logout-value */
$userID = Auth::user()->userID;
$LastLogout = Auth::user()->last_logout;
/* om last logout inte finns (när man precis registrerat sig) ska vi inte söka efter det heller */
  if(is_null($LastLogout)){
    /* sätter variabel för hur många notiser man har */
        $LastLogout = Auth::user()->created_at;
       }
      
        /*hämtar ut notiserna och räknar antalet, sätter variabel av antalet */
              $notiNr = DB::table('subscribe')->join('channels', 'channels.channelID', '=', 'subscribe.channelID')->join('sounds', 'sounds.channelID', '=', 'channels.channelID')->where('subscribe.userID', '=', $userID)->where('sounds.created_at', '>', $LastLogout)
       ->orderBy('sounds.created_at', 'DESC')->count();
if($notiNr == 0) {
  $notiNr = '';
}
if($notiNr > 0){
$titleNr = '(' . $notiNr . ')';

}
else {
$titleNr = '';


}       

?>
<p id="notif">{{ $notiNr }}</p>
</div>

</div>
<title>Herz {{$titleNr}} </title>



@else
<title>Herz</title>
    @endif

    <!-- Bootstrap core CSS -->
    <link href="http://localhost/Herz/public/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://localhost/Herz/public/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://localhost/Herz/public/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://localhost/Herz/public/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

 




    <!-- Fixed navbar Börjar här -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container" id="nav"> 
       <!-- Logo och Herz -->    
        <div class="navbar-header">          
          <a class="navbar-brand" id="logo" href="http://localhost/Herz/public/"><img src="http://localhost/Herz/public/images/navbrand.png"><p id="logo-text">Herz</p></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <!-- Vänster delen av naven  -->
          <ul class="nav navbar-nav">
          <!-- Dropdown meny vänster --> 
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="menu"><img src="http://localhost/Herz/public/images/menu4.png"><span class="caret"></span></a>
              <ul class="dropdown-menu" id="hmenu">
                <li><a href="http://localhost/Herz/public/channel">Kanaler</a></li>        
                <li><a href="http://localhost/Herz/public/sound">Podcasts</a></li>
                <li role="separator" class="divider"></li>
                 <li class="dropdown-header">Upptäck</li>
                <li><a href="#">Senast uppladdat</a></li>
                <li><a href="#">Populärt</a></li>
                <li><a href="#">Rekomendationer</a></li>
                <li><a href="#">Veckans pod</a></li>
                <li role="separator" class="divider"></li>
                <!-- Kollar om admin är inloggad och lägger till administration i menyn -->
                @if(Auth::check())
                <?php
                $username = Auth::user()->username;
                ?>
                @if($username == 'Herzteam')

                <li class="dropdown-header">Administrativt</li>
                <li><a href="http://localhost/Herz/public/category/create">Administrera kategorier</a></li>
                <li><a href ="#">Ta bort användare</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Om Herz</li>

                @else
                <li class="dropdown-header">Om Herz</li>
                @endif
                @endif
                <li><a href="http://localhost/Herz/public/about">Vad är Herz</a></li>
                <li><a href = "http://localhost/Herz/public/support">Support</a></li>
              </ul>
            </li>
            <!-- Sökfunktion -->
<div id="search" >  
              <form action="http://localhost/Herz/public/search/index">
              <div class="input-group">
            <div class="input-group-btn">
              <button tabindex="-1" data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
              <span class="caret"></span>
              </button>
              <ul role="input" class="dropdown-menu">
              <script type="text/javascript">$('.dropdown-menu').click(function(e) {
    e.stopPropagation();
});</script>
                                   <!-- Kategorier i sökfältet -->
                  <!-- gör php för att hämta ut kategorierna-->
                  <?PHP
                  $categories = DB::table('category')->orderBy('categoryname', 'asc')->get();
                  ?>
                    
                    @foreach($categories as $category)
                     <li><a>
                      <input type="checkbox" value="{{ $category->categoryID }}"><span class="lbl">{{$category->categoryname}}</span></a>
                      </li>
                 @endforeach
              
        
              </ul>
             </div>
            <input type="search" class="form-control" name="search"/>
            <div class="input-group-btn">
            <button tabindex="-1" class="btn btn-default" type="submit">Sök</button></div>
          </div>
</form>
          </div>
            
              <!-- Sökfältet slut -->
          </ul><!-- Vänster delen av naven slut -->

          <!-- Höger delen av naven slut -->
          <ul class="nav navbar-nav navbar-right">
             @if(Auth::check())
             <?php $userID = Auth::user()->userID; ?>
            <!-- Komment/Favorti Knappar -->
            <li class="knapp" id="nav-knapp">
 <li class="dropdown" id="nav-knapp">                        
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="NotiTrigger"><span id="prenIcon" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><span class="caret"></span></a><form action="" id="prenNoti" name="prenNoti" method="post">{!! csrf_field() !!}<input type="hidden" name="userID" id="userID" value="{{ $userID }}"></form>
              <ul class="dropdown-menu">
                <div id="prenNotiLI" class="PREN"></div>
              </ul>
              </li>

              <script>
               $(function()
{

$('#NotiTrigger').click(function(){


  $('#prenNoti').trigger('submit');

  });

$('#prenNoti').submit(function(e){
e.preventDefault();
var userID = $('#userID').val();

 $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://localhost/Herz/public/notiPren.php',
  data: { userID: userID},  
        dataType: 'text',

   success: function(data){ 

var current = document.getElementById('prenNotiLI').innerHTML;
var c = current.length;
var nr = c + 2;
var d = data.length;


if(d == nr){ 

$('#prenIcon').removeClass('NOTI');
}
else {
if(nr<10){
  $('#prenNotiLI').html(data);
}
else{
$('#prenNotiLI').html(data);
$('#prenNotiLI').change();
}
}

   },
   error: function() {

   }
});
 });

  


$('#prenNotiLI').on('change', function() {
$('#prenIcon').addClass('NOTI');
});




});
   </script>

 <li class="dropdown" id="nav-knapp">                        
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a>Element 1</a></li>
                <li><a>Element 2</a></li>
                <li><a>Element 3</a></li>
                <li><a>Element 4</a></li>
                <li><a>Element 5</a></li>
              </ul>
              </li>

 <li class="dropdown" id="nav-knapp">                        
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a>Element 1</a></li>
                <li><a>Element 2</a></li>
                <li><a>Element 3</a></li>
                <li><a>Element 4</a></li>
                <li><a>Element 5</a></li>
              </ul>
                      </li>    
</li>
@endif


            </li>

            <!-- Komment/Favorit Knappar Slut -->  
                            @if(Auth::check())
                            <?php
              $user = Auth::user()->userID;
              $channel = DB::table('channels')->where('channelID', '=', $user)->first();   

              if (is_null($channel)) {
    $link = 'channel/create';
    $upload = 'channel/create';
} 
else {
    $link = 'channel/' . $channel->channelID . ' ';
    $upload = 'sound/create';
} 
              ?>

          <!-- Användarens namn -->      
          <li id="user"><a href="http://localhost/Herz/public/user/{{ Auth::user()->userID }}">{{ Auth::user()->username }}</a></li>
            <!-- Användarens meny -->  
            <li class="dropdown" id="user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <!-- gör variabler för att kunna hämta ut data, samt göra olika länkar beroende på om någon har kanal eller inte -->              
              <img src="{{ Auth::user()->profilePicture }}" width="50px" height="50px" id="user-img"><span class="caret"></span></a>
              <ul class="dropdown-menu" id="usermd">
                <li class="dropdown-header">Profil</li>
                <li><a href="http://localhost/Herz/public/user/{{ Auth::user()->userID }}">Min Profil</a></li>
                <li><a href="http://localhost/Herz/public/user/{{ Auth::user()->userID }}/edit">Redigera Profil</a></li>
                <li><a href="http://localhost/Herz/public/favorite">Favoriter</a></li>
                <li><a href="http://localhost/Herz/public/subscribe">Prenumerationer</a></li>
                <li><a href="http://localhost/Herz/public/playlist">Mina Spellistor</a></li>
                <br>
                <li><a href="http://localhost/Herz/public/auth/logout" action="auth.logout">Logga ut</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Kanal</li>
                <li><a href="http://localhost/Herz/public/{{ $link }}">Min Kanal</a></li>
                <!-- om man trycker redigera kanal gör denna kollen så man kommer till skapa kanal om man ej har någon, kommer till redigera sin kanal om man har en kanal -->
              @if (is_null($channel)) 
              <li><a href="http://localhost/Herz/public/channel/create">Redigera Kanal</a></li>
                
                @else
                <li><a href="http://localhost/Herz/public/channel/{{ Auth::user()->userID }}/edit">Redigera Kanal</a></li>
                @endif
                <li><a href="http://localhost/Herz/public/{{ $upload }}">Ladda upp podcast</a></li>
              </ul> 
            </li><!-- Användarens meny slut-->
          



 @else
          <!-- Höger meny när man är ej inloggad-->   
            <li><a href="http://localhost/Herz/public/register" id="reg-log">Registrera dig</a></li> 
            <li class="divider-vertical"></li>
            <!-- lägger variabel på class och id för att kunna ha olika om fel inloggningsuppgifter: FÖRSTA OM FAILAR ANDRA OM EJ-->
             @if (count($errors) > 0)
                   <?php

                   $text = "Försök Igen";

                  

                   $loginID = 'reglogfail';
                   $loginID2 = 'login-menu-fail';
                  
                   ?>
@else
                <?php

                $text = "Logga In";


                   $loginID = 'reglog';
                   $loginID2 = 'login-menu';
               
                   ?>
                   @endif
              <li class="dropdown" id="user-menu">                        
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="{{ $loginID }}">{{$text}}<span class="caret"></span></a>
              <!-- Logga In meny -->                   
                <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;" id="{{ $loginID2 }}">
                  <form action="http://localhost/Herz/public/auth/login" method="post" accept-charset="UTF-8">
                {!! csrf_field() !!}
                    <p>E-mail</p>
                    <input id="user_username" style="margin-bottom: 15px;" type="text" name="email" size="30" />
                    <p>Lösenord</p>
                    <input id="user_password" style="margin-bottom: 15px;" type="password" name="password" size="30" />
  
                  

                    <input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" name="commit" value="Logga In" />
</form>
 <form action="http://localhost/Herz/public/resetPassword" method="post" accept-charset="UTF-8">
   {!! csrf_field() !!}
                 <button type="submit" id="changePass" class="btn btn-success">Glömt Lösenord</button>
                      {!! Form::close() !!}
                   @if (count($errors) > 0)
               
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        @if(Session::has('message'))
<div class="alert alert-success">
    {{ Session::get('message') }}
   </div>
@endif
                
                @endif

            </ul><!-- Logga In/Dropdown meny slut-->      
            </li> 

            </div>
            </div> 
              




      @if(Auth::check())
      <div class="line"><hr></div>

      
    </div>
  </div>
  </div>

    <!--Slut sidebar-->
@endif

    </nav>
<!--Slut Nav-->

      @yield('container')

      @yield('footer')    
<br>
<br>
<br>
<div id="footer">
      <div class="container">
      <br>
        <p class="muted credit">©Herz Projekt</p>
      </div>
</div>




 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     
   <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')
    // Add slideDown animation to dropdown


$('.dropdown').on('show.bs.dropdown', function(e){
  $(this).find('.dropdown-menu').first().stop().slideDown();
});

// Add slideUp animation to dropdown
$('.dropdown').on('hide.bs.dropdown', function(e){
  $(this).find('.dropdown-menu').first().stop().slideUp();
});




    </script>
      
    <script src="http://localhost/Herz/public/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://localhost/Herz/public/js/ie10-viewport-bug-workaround.js"></script>
    <!-- Bootstrap core JavaScript
    ================================================== -->

</html>
