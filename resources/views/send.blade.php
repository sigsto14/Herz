<!DOCTYPE HTML>
@include('template');
<html>
<head>
</head>
<body>
<!-- ett hemligt formulär för att skicka nytt lösenord till användare -->
<!-- just nu skickas till sigsto14 på hh.se, men kommer att kunna ändras till e-mail om någonsin finns server för det -->
<div class="hidden">
 <form action="http://ideweb2.hh.se/~sigsto14/Test/send.php" method="post">
 {!! csrf_field() !!} 

<input type="text" name="password" id="password" value="{{ $str }}">
<input type="text" name="user" id="user" value="{{ $user->username }}">
 <button type="submit" class="btn btn-default" id="send">Skicka</button> 

</form> 


</div>
<!-- script som triggar skicka-knappen på document ready så att formuläret skickas -->
<script>
$(document).ready(function() {
$('#send').trigger('click');

 

});

</script>

</body>
</html>