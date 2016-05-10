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

<title>Herz </title>
                <?php
                //kollar så användaren är inloggad
                if(Auth::check()){
                	//gör variabler om användaren är inloggad
                	  //Gör variabel av inloggad användares användarnamn
                $username = Auth::user()->username;
                	//inloggad användares id
$userID = Auth::user()->userID;
//använder variabel för att kolla om aktuell användare har en kanal
 $channel = DB::table('channels')->where('channelID', '=', $userID)->first();   
//ändrar länkar i användarmeny beroende på resultat 
              if (is_null($channel)) {
              	//om ej kanal blir länken 'Min kanal' att skapa kanal
    $link = 'channel/create';
    			//om ej kanal blir länken 'Ladda upp podcast' att skapa kanal
    $upload = 'channel/create';
} 
else {
	//om användaren har kanal blir länken "Min kanal" till kanal o ladda upp till att ladda upp podcast.
    $link = 'channel/' . $channel->channelID . ' ';
    $upload = 'sound/create';
} 
              
}
//hämtar ut kategorier ur databasen, arrangerar de i bokstavsodrning
      $categories = DB::table('category')->orderBy('categoryname', 'asc')->get();
//inloggningsfunktion, använder validator i auth-controller för att ändra i feedback till användaren
                if(count($errors) > 0){
                	//om det finns fel ändras text och classes
				   $text = "Försök Igen";
                   $loginID = 'reglogfail';
                   $loginID2 = 'login-menu-fail';
                  
                }
                else {
                	//om det inte finns fel ändras inte text eller klasser
 				   $text = "Logga In";
				   $loginID = 'reglog';
                   $loginID2 = 'login-menu';
                }
                ?>

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
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="menu"><span class="icon-menu"></span><span class="caret"></span</a>
              <ul class="dropdown-menu" id="hmenu">
              
         
                <li class="dropdown-header">Upptäck</li>
                <li><a href="#">Senast uppladdat</a></li>
                <li><a href="#">Populärt</a></li>
                <li><a href="#">Rekomendationer</a></li>
                <li><a href="#">Veckans pod</a></li>
                <li role="separator" class="divider"></li>

               

<!-- kollar om någon är inloggad -->
@if(Auth::check())
                <!--kollar om användarnamnet är adminkontot -->
@if($username == 'Herzteam')
<!-- fler behörigheter om inloggad på admin konto -->
                <li class="dropdown-header">Administrativt</li>
                <li><a href="http://localhost/Herz/public/category/create">Administrera kategorier</a></li>
                <li><a href ="#">Ta bort användare</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Om Herz</li>

@else
                <!-- om inte användarkonto -->
                <li class="dropdown-header">Om Herz</li>
                <!-- slut på auth::check och om användare är admin -->
@endif
@endif
                <li><a href="http://localhost/Herz/public/about">Vad är Herz</a></li>
                <li><a href = "http://localhost/Herz/public/support">Support</a></li>
              </ul>
            </li>
<!-- Sökfunktion -->
<div id="search" >  
<!-- formulär för sökfunktion -->
<!-- pga konflikter i laravels routes länkas action som vanlig http (och routas om till controller i routes.php)-->
<form class="form-wrapper cf" action="http://localhost/Herz/public/search/index">
       <div class="input-group">
            <div class="input-group-btn">
              <button tabindex="-1" data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"  aria-haspopup="true"><span class="caret"></span></button>
   <ul role="input" class="dropdown-menu" id="sokdrop">
                          <!-- Kategorier i sökfältet -->
               
                    <!-- en foreach loop hämtar ut var kategori individuellt -->
@foreach($categories as $category)
<!-- checkbox för kategorier i sökfunktionen -->
<li><a>
<input type="checkbox" value="{{ $category->categoryID }}" name="categoryID" id="categoryID"><span class="lbl">{{$category->categoryname}}</span>
</a></li>

@endforeach
<!-- slut på categoryloop -->
  </ul>
             </div>
<!-- själva sökfältet -->
            <input type="search" class="form-control" name="search" placeholder="  Sök..." id="sokinput"/>
<!-- sökknapp -->
            <div class="input-group-btn">
            <button tabindex="-1" class="btn btn-default" type="submit" id="sokknapp">Sök</button>
            </div>
     </div>
</form>
          </div>
            
<!-- Sökfältet slut -->
          </ul>
<!-- Vänster delen av naven slut -->


<!-- meny för inloggad användare-->
          <ul class="nav navbar-nav navbar-right">
<!-- kollar så användaren är inloggad-->
@if(Auth::check())
            
<!-- Prenumeration/Favoritmarkering/Kommentar Knappar -->
     <li class="knapp" id="nav-knapp">
        <li class="dropdown notify" id="nav-knapp">  
<!-- prenumerationknapp -->                      
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="NotiTrigger"><span id="prenIcon" class="icon-eye" aria-hidden="true"></span><span class="caret"></span></a>
<!-- ett formulär som genom ajaxscript hämtar ut senaste nytt i prenumerationer när dropdown öppnas -->
            <form action="" id="prenNoti" name="prenNoti" method="post" class="noti">{!! csrf_field() !!}<input type="hidden" name="userID" id="userID" value="{{ $userID }}"></form>
              <ul class="dropdown-menu" id="notisdrop2">
<!-- tom div där data läses in genom ajax -->
                <div id="prenNotiLI" class="notislist"></div>
              </ul>
         </li>

              

 		<li class="dropdown notify2" id="nav-knapp">    
<!-- favoritknapp -->                     
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="NotiTrigger2"><span id="favIcon" class="icon-heart3" aria-hidden="true"></span><span class="caret"></span></a>
<!-- ett formulär som genom ajaxscript hämtar ut senaste favoritmarkeringar när dropdown öppnas -->
              <form action="" id="favNoti" name="favNoti" method="post" class="noti">{!! csrf_field() !!}<input type="hidden" name="userID2" id="userID2" value="{{ $userID }}"></form>
              <ul class="dropdown-menu" id="notisdrop2">
<!-- tom div där data läses in genom ajax -->
                  <div id="favNotiLI" class="notislist"></div>
              </ul>
        </li>

 		<li class="dropdown notify3" id="nav-knapp">  
<!-- kommentarknapp -->                       
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="NotiTrigger3"><span id="comIcon" class="icon-comment" aria-hidden="true"></span><span class="caret"></span></a>
<!-- ett formulär som genom ajaxscript hämtar ut senaste kommentarer när dropdown öppnas -->
              <form action="" id="comNoti" name="comNoti" method="post" class="noti">{!! csrf_field() !!}<input type="hidden" name="userID3" id="userID3" value="{{ $userID }}"></form>
              <ul class="dropdown-menu" id="notisdrop3">
<!-- tom li där data läses in genom ajax -->
                  <li id="comNotiLI" class="notislist"></li>
              </ul>
          </li>
      </li>

<!-- använder laravel Auth för att hämta ut inloggad användares id och användarnamn -->    
        <li id="user"><a href="http://localhost/Herz/public/user/{{ Auth::user()->userID }}">{{ Auth::user()->username }}</a></li>
<!-- Användarens meny -->  
         <li class="dropdown" id="user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  
<!-- använder laravel Auth för att hämta ut inloggad användares profilbild -->          
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
<!-- avnänder linkvariabel för att dirigera användaren rätt beroende på om det finns kanal eller ej -->
                <li><a href="http://localhost/Herz/public/{{ $link }}">Min Kanal</a></li>
           
         
          
<!-- använder channelvariabel för att kolla om användaren har kanal (genom att kolla om variabeln INTE är tom) -->
@if(!is_null($channel)) 
<!-- kan redigera kanal om kanal finns -->
                <li><a href="http://localhost/Herz/public/channel/{{ $userID }}/edit">Redigera Kanal</a></li>
@endif
                <!-- avnänder linkvariabel för att dirigera användaren rätt beroende på om det finns kanal eller ej -->
                <li><a href="http://localhost/Herz/public/{{ $upload }}">Ladda upp podcast</a></li>
            </ul> 
            </li><!-- Användarens meny slut-->
          
@else
          <!-- Höger meny när man är ej inloggad-->   
            <li><a href="http://localhost/Herz/public/register" id="reg-log">Registrera dig</a></li> 
            <li class="divider-vertical"></li>

           
              <li class="dropdown" id="logindrop">     
              <!-- använder variabler för att ge olika text i "Logga in"- rubriken beroende på om fel eller ej -->                   
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="{{ $loginID }}">{{$text}}<span class="caret"></span></a>
              <!-- Logga In meny -->                   
                <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;" id="{{ $loginID2 }}">
                  <!-- formulär för inloggning -->
                <form action="http://localhost/Herz/public/auth/login" method="post" accept-charset="UTF-8">
                  <!-- laravel skydd mot csrf-inmatning -->
                    {!! csrf_field() !!}
                    <p>E-mail</p>
                    <input id="user_username" style="margin-bottom: 15px;" type="text" name="email" size="30" />
                    <p>Lösenord</p>
                    <input id="user_password" style="margin-bottom: 15px;" type="password" name="password" size="30" />
                    <input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" name="commit" value="Logga In" />
				</form>
				<!-- slut inloggningsformulär -->
				<!-- knapp/länk för glömt lösenord -->
                 <button type="submit" id="changePass" class="btn btn-success"><a href="http://localhost/Herz/public/resetPassword">Glömt Lösenord</a></button>
<!-- feedback genom validator feedback (inloggningsfunktion)-->
@if (count($errors) > 0)
<div class="alert alert-danger" id="loginmsg">
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
<!-- slut feedback -->
@endif
<!-- slut auth checkelse -->

            </ul><!-- Logga In/Dropdown meny slut-->      
            </li> 
		</div>
            </div> 
                        <!-- Höger delen av naven slut -->




@if(Auth::check())
      <div class="line"><hr></div>

      
    </div>
  </div>
  </div>
@endif
</nav>

      @yield('container')

      @yield('footer')    
<br>
<br>
<br>
<div class="footer">
      <div class="container">
      <br>
<p class="muted credit">©Herz Projekt</p>
      </div>
</div>

<!-- kallar in ajaxbiblioteket -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <!-- script för dropdownfunktioner-->
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
      
    <!-- js för notifikationshantering -->
<script src="http://localhost/Herz/public/js/notifications.js"></script>
	<!--js för titlealert notifications -->
<script type="text/javascript" src="http://localhost/Herz/public/js/jquery.titlealert.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="http://localhost/Herz/public/js/ie10-viewport-bug-workaround.js"></script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
<script src="http://localhost/Herz/public/js/bootstrap.min.js"></script>
</html>
