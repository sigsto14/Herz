@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<body>
	@yield('content')
    <div class="container">
    <div class="col-md-12" id="container">
        	<h1>Kontakta oss</h1>
        	<p>Om du har något du undrar över kan du ställa en fråga till oss. Fyll i din e-post adress så kan vi återkomma till dig.</p>
		<div>
			<!--<form action="http://ideweb2.hh.se/~sigsto14/Test/contact.php" method="post" id="contact">-->
			{!! csrf_field() !!} 
			<input type="text" name="email" class="form-controll" placeholder="Din epost"><br>
			<input type="text" name="msg" class="form-controll" placeholder="Ditt meddelande"><br>
			<button type="submit" class="btn btn-default">Skicka</button>

			</form> 
		</div>

<!--FAQ-ruta-->

		<div class="faq">
				<!--<div class="panel-heading">
	            <h4 class="panel-title">
			 <a data-toggle="collapse" data-target="#collapseOne" href="#collapseOne">Prenumerationer</a>
				</h4>
			</div>-->

			<button type="button" class="btn" data-toggle="collapse" data-target="#demo">Jag vill ladda upp ett eget ljudklipp</button><br>
	  			<div id="demo" class="collapse">
					<p>Se till så att du har skapat en kanal. I den högra menyn längst ner hittar du "Ladda upp podcast". Här kan du ladda upp ditt ljudklipp.</p>
	  			</div>
	  		<button type="button" class="btn" data-toggle="collapse" data-target="#demo2">Jag vill anmäla ett klipp</button><br>
	  			<div id="demo2" class="collapse">
					<p>Se till så att du har skapat en kanal. I den högra menyn längst ner hittar du "Ladda upp podcast". Här kan du ladda upp ditt ljudklipp.</p>
	  			</div>
			<button type="button" class="btn" data-toggle="collapse" data-target="#demo3">Måste jag ha rättigheter till ljudklippet jag laddar upp</button><br>
	  			<div id="demo3" class="collapse">
					<p>Se till så att du har skapat en kanal. I den högra menyn längst ner hittar du "Ladda upp podcast". Här kan du ladda upp ditt ljudklipp.</p>
	  			</div>
	  		<button type="button" class="btn" data-toggle="collapse" data-target="#demo4">Måste jag ha rättigheter till ljudklippet jag laddar upp</button><br>
	  			<div id="demo4" class="collapse">
					<p>Se till så att du har skapat en kanal. I den högra menyn längst ner hittar du "Ladda upp podcast". Här kan du ladda upp ditt ljudklipp.</p>
	  			</div>	
	  		<button type="button" class="btn" data-toggle="collapse" data-target="#demo5">Måste jag ha rättigheter till ljudklippet jag laddar upp</button><br>
	  			<div id="demo5" class="collapse">
					<p>Se till så att du har skapat en kanal. I den högra menyn längst ner hittar du "Ladda upp podcast". Här kan du ladda upp ditt ljudklipp.</p>
	  			</div>	
		</div>
		
	</div>
	</div>
</body>