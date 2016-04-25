<!DOCTYPE HTML>
@include('template');
<html>
<head>
</head>
<body>
<div class="hidden">
 <form action="http://ideweb2.hh.se/~sigsto14/Test/send.php" method="post">
 {!! csrf_field() !!} 

<input type="text" name="password" id="password" value="{{ $str }}">
<input type="text" name="user" id="user" value="{{ $user->username }}">
 <button type="submit" class="btn btn-default" id="send">Skicka</button> 

</form> 


</div>
<script>
$(document).ready(function() {
$('#send').trigger('click');

 

});

</script>

</body>
</html>