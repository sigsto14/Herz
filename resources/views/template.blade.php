<!DOCTYPE html>


<html lang="sv">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="En svensk podcast plattform">
    <meta name="author" content="Herz">
    <link rel="icon" href="../../favicon.ico">

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
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://localhost/Herz/public/">Herz</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Meny<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="http://localhost/Herz/public/user">Användare</a></li>
                <li><a href="http://localhost/Herz/public/{{ $link }}">Ladda upp podcast</a></li>
                <li><a href="http://localhost/Herz/public/sound">Podcasts</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Om Herz</li>
                <li><a href="#">Meny 1</a></li>
                <li><a href="#">Meny 2</a></li>
              </ul>
            </li>
            <!-- Sökfältet -->
                <div id="search" >       
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Sök">
                <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategorier <span class="caret"></span></button>
                  <ul class="dropdown-menu dropdown-menu-right">
                  <!-- Kategorier i sökfältet -->
                  <li><a href="#">Musik</a></li>
                  <li><a href="#">History</a></li>
                  <li><a href="#">Underhållning</a></li>
                </ul>
              </div><!-- /btn-group -->
              </div><!-- /input-group -->
              </div>
              <!-- Sökfältet slut -->
          </ul>
          <ul class="nav navbar-nav navbar-right">
             @if(Auth::check())

            <li class="dropdown">  
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <!-- gör variabler för att kunna hämta ut data, samt göra olika länkar beroende på om någon har kanal eller inte -->
              
            <img src="{{ Auth::user()->profilePicture }}" width="50px" height="50px"><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Profil</li>
                <li><a href="http://localhost/Herz/public/user/{{ Auth::user()->userID }}">Min Profil</a></li>
                <li><a href="http://localhost/Herz/public/user/{{ Auth::user()->userID }}/edit">Redigera Profil</a></li>
                <li><a href="#">Favoriter</a></li>
                <li><a href="#">Prenumerationer</a></li>
                <br>
                <li><a href="http://localhost/Herz/public/auth/logout">Logga ut</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Kanal</li>
                <li><a href="http://localhost/Herz/public/{{ $link }}">Min Kanal</a></li>
              
                <li><a href="#">Redigera Kanal</a></li>
                <li><a href="http://localhost/Herz/public/{{ $upload }}">Ladda upp podcast</a></li>
              </ul> 
            </li>
          
       <!--/.nav-collapse -->
@endif
          @if(Auth::check())
          <li><a href="http://localhost/Herz/public/user/{{ Auth::user()->userID }}">{{ Auth::user()->username }}</a></li>
 @else
     <li><a href="http://localhost/Herz/public/auth/register">Registrera dig</a></li>    

          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Logga In <strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
              <!-- Login form here -->
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
            </div>  
         
      </div>
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
              <a data-toggle="collapse" data-target="#collapseTwo" href="#collapseTwo">Favoriter</a>
            </h4>
        </div>
        
        <div id="collapseTwo" class="panel-collapse collapse in">
            <div class="panel-body">
          <table class="pre-fav" style="width:100%">
          <tr>
            <td>1</td>
            <td><img src="http://localhost/Herz/public/images/user_av/ava_50.jpg"style="width:50%" ></td>    
            <td><a href="#">Favorit 1</a></td>
            <td>av</td>
            <td><a href="#">Herz</a></td>
          </tr>
          <tr>
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
          </tr>
        </table>
            </div>
        </div>
    </div>
  </div>
  </div>
    </nav>

<br><br><br><br>



      @yield('container')

      @yield('footer')    






 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="http://localhost/Herz/public/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://localhost/Herz/public/js/ie10-viewport-bug-workaround.js"></script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

  </body>
</html>
