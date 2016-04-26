@extends('template')
@section('container')
@section('footer')

<!DOCTYPE html>
<html>
<head>
	<title>Välkommen till Herz</title>

	<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
	<link rel="stylesheet" type="text/css" href="http://localhost/Herz/public/engine0//style.css" />
	<script type="text/javascript" src="http://localhost/Herz/public/engine0//jquery.js"></script>
	<!-- End WOWSlider.com HEAD section -->
</head>
<body>
<div class="container">

    <div class="col-md-12" id="container">
    <div id="bildspel1">	
		<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
		<div id="wowslider-container0">
		<div class="ws_images"><ul>
			<li><img src="http://localhost/Herz/public/data0/images/herzheader5.png" alt="Herz-header5" title="Herz-header5" id="wows0_0"/></li>
			<li><a href="http://wowslider.com"><img src="http://localhost/Herz/public/data0/images/herzheader4.png" alt="wowslider.com" title="Herz-header4" id="wows0_1"/></a></li>
			<li><img src="http://localhost/Herz/public/data0/images/herzheader3.png" alt="Herz-header3" title="Herz-header3" id="wows0_2"/></li>
		</ul></div>
		<div class="ws_bullets"><div>
			<a href="#" title="Herz-header5"><span><img src="http://localhost/Herz/public/data0/tooltips/herzheader5.png" alt="Herz-header5"/>1</span></a>
			<a href="#" title="Herz-header4"><span><img src="http://localhost/Herz/public/data0/tooltips/herzheader4.png" alt="Herz-header4"/>2</span></a>
			<a href="#" title="Herz-header3"><span><img src="http://localhost/Herz/public/data0/tooltips/herzheader3.png" alt="Herz-header3"/>3</span></a>
		</div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.com">slider</a> by WOWSlider.com v8.7</div>
		<div class="ws_shadow"></div>
		</div>	
		<script type="text/javascript" src="http://localhost/Herz/public/engine0//wowslider.js"></script>
		<script type="text/javascript" src="http://localhost/Herz/public/engine0//script.js"></script>
		<!-- End WOWSlider.com BODY section -->
    </div>    
	<div class="fields" >
    	<div class="register_field">
            <h1>Registrera dig</h1>
            <form>    
                <div>
        	       <label>Användarnamn:</label>
        	       <input type="text" name="username" value="{{ old('username') }}">
                </div>

                <div>
        	       <label>Email:</label>
        	       <input type="email" name="email" value="{{ old('email') }}">
                </div>

                <div>
       		       <label>Lösenord:</label>
        	       <input type="password" name="password">
                </div>

                <div>
        	       <label>Bekräfta lösenordet:</label>
        	       <input type="password" name="password_confirmation">
                </div>
            </form>
		</div>

		<div class="login_field">
            <h1>Logga in</h1>
            <form>
                <div>
        	       <label>Email:</label>
        	       <input type="email" name="email" value="{{ old('email') }}">
                </div>

                <div>
        	       <label>Password:</label>
        	       <input type="password" name="password" id="password">
                </div>
            </form>
    	</div>
        <div id="field_buttons">
                <div id="register_button" class="submit_button_style">
                   <button type="submit" class="submit_button"><span>Registrera dig</span></button>
                </div>

                <div id="login_button" class="submit_button_style">
                   <button type="submit" class="submit_button"><span>Login</span></button>
                </div>               
        </div>
    </div>    
	</div>
</div>	
</body>
</html>