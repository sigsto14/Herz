@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<body>
	@yield('content')
    <div class="container">
    <div class="col-md-12" id="container">
        	<h1>Kontakta oss</h1>
        	<p>Om du har något du undrar över kan du ställa en fråga till oss. Fyll i din e-post adress så kan vi återkomma till dig. Eller så kanske du hittar svaret på frågan längre ner på sidan.</p>
		<div>
			<form action="http://ideweb2.hh.se/~sigsto14/Test/contact.php" method="post" id="contact">
			{!! csrf_field() !!} 
			<input type="text" name="email" class="form-controll" placeholder="Din epost"><br>
			<textarea rows="4" cols="50" name="msg" placeholder="Ditt meddelande"></textarea><br><br>
			<button type="submit" class="btn btn-default">Skicka</button>
			</form> 
		</div>

<!--FAQ-ruta-->

		<div class="faq">

			<h2>FAQ</h2>
			<button type="button" class="btn" data-toggle="collapse" data-target="#faq1">Jag vill ladda upp ett eget ljudklipp, hur gör jag?</button><br>
	  			<div id="faq1" class="collapse">
					<p>Se till så att du har skapat en kanal. I den högra menyn längst ner hittar du "Ladda upp podcast". Här kan du ladda upp ditt ljudklipp.</p>
	  			</div>
	  		<button type="button" class="btn" data-toggle="collapse" data-target="#faq2">Jag har upptäckt en podcast som jag anser är stötande eller bryter mot svensk lagstiftning. Hur gör jag för att få det borttaget?</button><br>
	  			<div id="faq2" class="collapse">
					<p>Du kan anmäla en podcast genom att gå in på podcasten och trycka på knappen "anmäl" Motivera varför du vill anmäla podcasten och skicka in ärendet till oss.</p>
	  			</div>
			<button type="button" class="btn" data-toggle="collapse" data-target="#faq3">Måste jag ha rättigheter till de ljud som jag laddar upp</button><br>
	  			<div id="faq3" class="collapse">
					<p>Ja du måste ha rättigheter till alla ljud som du laddar upp. Orginalinnehåll skyddas av upphovsrätten och får inte laddas upp av någon utan upphovsmannens tillstånd.</p>
	  			</div>
	  		<button type="button" class="btn" data-toggle="collapse" data-target="#faq4">Måste jag ha rättigheter till ljudklippet jag laddar upp</button><br>
	  			<div id="faq4" class="collapse">
					<p>Se till så att du har skapat en kanal. I den högra menyn längst ner hittar du "Ladda upp podcast". Här kan du ladda upp ditt ljudklipp.</p>
	  			</div>	
	  		<button type="button" class="btn" data-toggle="collapse" data-target="#faq5">Måste jag ha rättigheter till ljudklippet jag laddar upp</button><br>
	  			<div id="faq5" class="collapse">
					<p>Se till så att du har skapat en kanal. I den högra menyn längst ner hittar du "Ladda upp podcast". Här kan du ladda upp ditt ljudklipp.</p>
	  			</div>	
		</div>

<!--FAQ-ruta slut-->

	</div>
	</div>
</body>