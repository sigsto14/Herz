@extends('template')
@section('container')
@section('footer')

<!DOCTYPE html>
<html>
<head>
    <title>Välkommen till Herz</title>

    <!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="Made with WOW Slider - Create beautiful, responsive image sliders in a few clicks. Awesome skins and animations. Jquery slideshow" />
  
  <!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
  <link rel="stylesheet" type="text/css" href="engine1/style.css" />
  <script type="text/javascript" src="engine1/jquery.js"></script>
    <!-- End WOWSlider.com HEAD section -->
</head>
<body>
<div class="container" id="homeContainer">
    <div class="col-md-12" id="container3"> 
    <div id="bildspel1">    
<!-- Start WOWSlider.com BODY section -->
<div id="wowslider-container1">
  <div class="ws_images"><ul>
    <li><a href="http://wowslider.com"><img src="data1/images/herzheader2.png" alt="wow slider" title="" id="wows1_0"/></a></li>
    <li><img src="data1/images/herzheader3.png" alt="" title="" id="wows1_1"/></li>
  </ul></div>
  

  <div class="ws_shadow"></div>
  </div>  
  <script type="text/javascript" src="engine1/wowslider.js"></script>
  <script type="text/javascript" src="engine1/script.js"></script>
<!-- End WOWSlider.com BODY section -->
</div>

    <div class="fields">
        <ul class="nav nav-tabs" role="tablist" id="homeFields">
            <li role="presentation" class="active"><a id="navA" href="#registrera" role="tab" data-toggle="tab">Registrering</a></li>
            <li role="presentation"><a href="#loggain" id="navA" role="tab" data-toggle="tab">Logga in</a></li>
        </ul>
        <div id="wrapper">
        <script>
            $('#btnReview').click(function(){
            $(".tab-content").removeClass("active");
            $(".tab-content:first-child").addClass("active");
        });
        </script>

        <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="registrera">
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
          
        <h1 id="regTitle">Registrera dig:</h1><br>
            <div class="register_field" id="homereg">

                <form action="http://localhost/Herz/public/auth/register" method="POST">    
                {!! csrf_field() !!}
            <div>
            <input type="hidden" name="profilePicture" value="http://localhost/Herz/public/images/profilepictures/none.png">
            </div>
   
                <div>
                   <label>Användarnamn:</label>
                   <input type="text" name="username">
                </div>

                <div>
                   <label>Email:</label>
                   <input type="email" name="email">
                </div>

                <div>
                   <label>Lösenord:</label>
                   <input type="password" name="password">
                </div>

                <div>
                   <label>Bekräfta lösenordet:</label>
                   <input type="password" name="password_confirmation">
                </div>
                  <div id="register_button" class="submit_button_style">
                      <button type="submit" class="btn" style="  
  border: none;
  font-size: 16px;
  height: auto;
  margin: 0;
  outline: 0;
  padding: 15px;
  width: 90%;
   margin-bottom: 30px;">Registrera dig</button>
                </div>
            
                </form>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="loggain">
        <h1 id="regTitle">Logga in:</h1><br><br>
                  
          
            <div class="login_field" id="homereg">
             
                <form action="http://localhost/Herz/public/auth/login" method="POST">
                {!! csrf_field() !!}
                    <div>
                        <label>Email:</label>
                        <input type="email" name="email" value="{{ old('email') }}">
                    </div>

                    <div>
                        <label>Password:</label>
                        <input type="password" name="password" id="password">
                    </div>
                        <div id="login_button" class="submit_button_style">
                   <button type="submit" class="btn" style="  
  border: none;
  font-size: 16px;
  height: auto;
  margin: 0;
  outline: 0;
  padding: 15px;
  width: 90%;
   margin-bottom: 30px;">Logga in</button>
            </div>
        </div>
        </div>
            </form></div>
        </div>
    </div>    
    </div>
</div>  
</body>
</html>