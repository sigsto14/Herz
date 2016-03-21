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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

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
          <a class="navbar-brand" href="#">Herz</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Meny<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Meny 1</a></li>
                <li><a href="#">Meny 2</a></li>
                <li><a href="#">Meny 3</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Om Herz</li>
                <li><a href="#">Meny 1</a></li>
                <li><a href="#">Meny 2</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
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
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Profil</li>
                <li><a href="#">Redigera Profil</a></li>
                <li><a href="#">Meny 2</a></li>
                <li><a href="#">Meny 3</a></li>
                <br>
                <li><a href="#">Logga ut</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Kanal</li>
                <li><a href="#">Ladda upp</a></li>
                <li><a href="#">Kolla Kanal</a></li>
              </ul> 
            </li>     
          </ul>
        </div><!--/.nav-collapse -->

      </div>
    </nav>

    <div class="container">
          <div class="page-header">
            <h1>Navs</h1>
          </div>
          <div class="page-header"></div>
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#">Populärt just nu</a></li>
            <li role="presentation"><a href="#">Veckans pod</a></li>
            <li role="presentation"><a href="#">Senast uppladat</a></li>
          </ul> 
        </div>
    </div> <!-- /container -->

    @yield('container')

@yield('footer')



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
@stop