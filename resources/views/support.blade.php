@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<body>
	@yield('content')
    <div class="container">
<div class="col-md-3"></div>
<div class="col-md-6" id="mini-container">
<h1>Support</h1>
<div class="section">Kontakta oss</div>
    <div class="inner-wrap">       	

        	<p id="iw-center">Om du har något du undrar över kan du ställa en fråga till oss. Fyll i din <br> e-post adress så kan vi återkomma till dig.
        	 Eller så kanske du hittar svaret på frågan längre ner på sidan.</p>
		
<form action="http://ideweb2.hh.se/~sigsto14/Test/contact.php" method="post" id="contact">
			{!! csrf_field() !!}
			<input type="text" name="namn" placeholder="Ditt namn" data-toggle="tooltip" title="Skriv in ditt namn här"><br><br> 
			<input type="text" name="email" placeholder="Din e-mail" data-toggle="tooltip" title="Skriv in din e-postadress här"><br><br>
			<textarea rows="4" cols="50" name="msg" placeholder="Ditt meddelande"data-toggle="tooltip" title="Här skriver du ditt meddelande"></textarea><br><br>
			<button type="submit" class="btn btn-default">Skicka</button>
</form> 
		</div>

<!--FAQ-ruta-->
<div class="section">F.A.Q</div>
    <div class="inner-wrap">
			<button type="button" class="faqbtn" data-toggle="collapse" data-target="#faq1">Jag vill ladda upp ett eget ljudklipp, hur gör jag?</button><br>
	  			<div id="faq1" class="collapse">
					<p>Se till så att du har skapat en kanal. I den högra menyn längst ner hittar du "Ladda upp podcast". Här kan du ladda upp ditt ljudklipp.</p>
	  			</div>
	  		<button type="button" class="faqbtn" data-toggle="collapse" data-target="#faq2">Jag har upptäckt en podcast som jag anser är stötande eller bryter mot svensk lagstiftning. Hur gör jag för att få det borttaget?</button><br>
	  			<div id="faq2" class="collapse">
					<p>Du kan anmäla en podcast genom att gå in på podcasten och trycka på knappen "anmäl" Motivera varför du vill anmäla podcasten och skicka in ärendet till oss.</p>
	  			</div>
			<button type="button" class="faqbtn" data-toggle="collapse" data-target="#faq3">Måste jag ha rättigheter till de ljud som jag laddar upp?</button><br>
	  			<div id="faq3" class="collapse">
					<p>Ja du måste ha rättigheter till alla ljud som du laddar upp. Orginalinnehåll skyddas av upphovsrätten och får inte laddas upp av någon utan upphovsmannens tillstånd.</p>
	  			</div>
	  		<button type="button" class="faqbtn" data-toggle="collapse" data-target="#faq4">Jag vill komma i kontakt med en annan användare. Hur gör jag?</button><br>
	  			<div id="faq4" class="collapse">
					<p>Du kan kommentera på andras podcasts genom att gå in på podcastens</p>
	  			</div>	
	  		<button type="button" class="faqbtn" data-toggle="collapse" data-target="#faq5">Måste jag ha rättigheter till ljudklippet jag laddar upp</button><br>
	  			<div id="faq5" class="collapse">
					<p>Se till så att du har skapat en kanal. I den högra menyn längst ner hittar du "Ladda upp podcast". Här kan du ladda upp ditt ljudklipp.</p>
	  			</div>	
		</div>

<!--FAQ-ruta slut-->

<!-- Script för tooltips -->
<script>
	$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});
</script>
	</div>
	</div>
</body>