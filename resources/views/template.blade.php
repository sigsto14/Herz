<!DOCTYPE html>


<html lang="sv">
  <head>
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
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

    <title>Herz</title>


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
                <li><a href="http://localhost/Herz/public/user">Användare</a></li>        
                <li><a href="http://localhost/Herz/public/sound">Podcasts</a></li>
                <li role="separator" class="divider"></li>
                <!-- sätter o kollar om admin e inloggad så får man en fin meny -->
                @if(Auth::check())
                <?php
                $username = Auth::user()->username;
                ?>
                @if($username == 'Herzteam')

                <li class="dropdown-header">Administrativt</li>
                <li><a href="http://localhost/Herz/public/category/create">Administrera kategorier</a></li>

                @else
                <li class="dropdown-header">Om Herz</li>
                @endif
                @endif
                <li><a href="#">Meny 1</a></li>
                <li><a href="#">Meny 2</a></li>
              </ul>
            </li>
            <!-- Sökfältet -->
            <div id="search" >       
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Sök" id="searchf">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="kat">Kategorier <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right" id="search-button">
                  <!-- Kategorier i sökfältet -->
                  <!-- gör php för att hämta ut kategorierna-->
                  <?PHP
$categories = DB::table('category')->orderBy('categoryname', 'asc')->get();
?>
                     @foreach($categories as $category)
                      <li><a href="http://localhost/Herz/public/category/{{$category->categoryID}}">{{$category->categoryname}}</a></li>
                 @endforeach
                    </ul>
                  </div><!-- /btn-group -->
              </div><!-- /input-group -->
            </div>
              <!-- Sökfältet slut -->
          </ul><!-- Vänster delen av naven slut -->

          <!-- Höger delen av naven slut -->
          <ul class="nav navbar-nav navbar-right">
             @if(Auth::check())
            <!-- Komment/Favorti Knappar -->
            <li class="knapp" id="nav-knapp">
              <button type="button" class="btn btn-default btn-lg">
              <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
              </button>
              <button type="button" class="btn btn-default btn-lg">
              <span class=" glyphicon glyphicon-comment" aria-hidden="true"></span>
              </button> 
            </li>
            <!-- Komment/Favorti Knappar Slut -->  
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
                <li><a href="#">Prenumerationer</a></li>
                <br>
                <li><a href="http://localhost/Herz/public/auth/logout">Logga ut</a></li>
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

          

@endif

 @else
          <!-- Höger meny när man är ej inloggad-->   
            <li><a href="http://localhost/Herz/public/auth/register" id="reg-log">Registrera dig</a></li> 
            <li class="divider-vertical"></li>
              <li class="dropdown">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="reg-log">Logga In <strong class="caret"></strong></a>
                <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;" id="login-menu">
              <!-- Logga In meny -->
                  <form action="http://localhost/Herz/public/auth/login" method="post" accept-charset="UTF-8">
                {!! csrf_field() !!}
                    <p>E-mail</p>
                    <input id="user_username" style="margin-bottom: 15px;" type="text" name="email" size="30" />
                    <p>Lösenord</p>
                    <input id="user_password" style="margin-bottom: 15px;" type="password" name="password" size="30" />
                    <input id="user_remember_me" style="float: left; margin-right: 10px;" type="checkbox" name="user[remember_me]" value="1" />
                    <label class="string optional" for="user_remember_me"> Kom ihåg mig</label>
 
                    <input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" name="commit" value="Sign In" />
                </form>
              @endif
            </div><!-- Logga In/Dropdown meny slut-->                       
      </div>



      @if(Auth::check())
      <div class="line"><hr></div>

      <!--sidebar-->
      <div class="sidebar">
        <div class="prenumerering">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default" id="panel1">
              <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-target="#collapseOne" href="#collapseOne">Prenumerationer</a>
            </h4>
        </div>

        <div id="collapseOne" class="panel-collapse collapse in">
          <div class="panel-body">
            <table class="pre-fav" style="width:100%">
            <tr>
              <td>1</td>
              <td><img src="http://localhost/Herz/public/images/user_av/ava_50.jpg" style="width:65%"></td>    
              <td><a href="#">Prenumering 1</a></td>
              <td>av</td>
              <td><a href="#">Herz</a></td>
            </tr>
            <tr>
              <td>2</td>
              <td><img src="http://localhost/Herz/public/images/user_av/ava_50.jpg" style="width:65%"></td>   
              <td><a href="#">Prenumering 2</a></td>
              <td>av</td>
              <td><a href="#">Herz</a></td>
            </tr>
            <tr>
              <td>3</td>
              <td><img src="http://localhost/Herz/public/images/user_av/ava_50.jpg" style="width:65%"></td>    
              <td><a href="#">Prenumering 3</a></td>
              <td>av</td>
              <td><a href="#">Herz</a></td>          
            </tr>
            <tr>
              <td>4</td>
              <td><img src="http://localhost/Herz/public/images/user_av/ava_50.jpg" style="width:65%"></td>    
              <td><a href="#">Prenumering 4</a></td>
              <td>av</td>
              <td><a href="#">Herz</a></td>
            </tr>
            <tr>
              <td>5</a></td>
              <td><img src="http://localhost/Herz/public/images/user_av/ava_50.jpg" style="width:65%"></td>    
              <td><a href="#">Prenumering 5</a></td>
              <td>av</td>
              <td><a href="#">Herz</a></td>
            </tr>
          </table> 
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
            <div class="panel-body">
          <table class="pre-fav" style="width:100%">
          <tr>

            <!-- tar varje resultat (5 st) individuellt -->
            @foreach($favorites as $favorite)  
            <td><img src="{{ $favorite->podpicture }}"style="width:20px"></td>   
            <td><a href="http://localhost/Herz/public/sound/{{ $favorite->soundID }}">{{ $favorite->title }}</a></td>
            <td>KANAL:</td>
            <td><a href="http://localhost/Herz/public/channel/{{ $favorite->channelID }}">{{ $favorite->channelname}}</a></td></tr>
            @endforeach
            <tr>
            <td><p><a href="http://localhost/Herz/public/favorite">Se alla...</a></p></td></tr>
          
          <!-- tillfällig utkommentering<tr>
            <td>2</td>
            <td><img src="http://localhost/Herz/public/images/user_av/ava_50.jpg" style="width:50%"></td>   
            <td><a href="#">Favorit 2</a></td>
            <td>av</td>
            <td><a href="#">Herz</a></td>
          </tr>
          <tr>
          <td>3</td>
          <td><img src="http://localhost/Herz/public/images/user_av/ava_50.jpg" style="width:50%"></td>    
          <td><a href="#">Favorit 3</a></td>
          <td>av</td>
          <td><a href="#">Herz</a></td>          
          </tr>
          <tr>
            <td>4</td>
            <td><img src="http://localhost/Herz/public/images/user_av/ava_50.jpg" style="width:50%" ></td>    
            <td><a href="#">Favorit 4</a></td>
            <td>av</td>
            <td><a href="#">Herz</a></td>
          </tr>
           <tr>
            <td>5</a></td>
            <td><img src="http://localhost/Herz/public/images/user_av/ava_50.jpg" style="width:50%"></td>    
            <td><a href="#">Favorit 5</a></td>
            <td>av</td>
            <td><a href="#">Herz</a></td>
          </tr>-->
        </table>
            </div>
        </div>
    </div>
  </div>
  </div>

    <!--Slut sidebar-->
@endif

    </nav>
<!--Slut Nav-->

      @yield('container')

      @yield('footer')    






 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')
    // Add slideDown animation to dropdown
$('.dropdown').on('show.bs.dropdown', function(e){
  $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
});

// Add slideUp animation to dropdown
$('.dropdown').on('hide.bs.dropdown', function(e){
  $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
});
    </script>
    <script src="http://localhost/Herz/public/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://localhost/Herz/public/js/ie10-viewport-bug-workaround.js"></script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

  </body>
</html>
