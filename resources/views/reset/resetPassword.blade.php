<!DOCTYPE HTML>
@extends('template');
<html>
<head>
</head>

<body>
<div class="container">
<div class="col-md-12" id="container">

<p> Skriv din registrerade email i fälten nedan så skickar Herz ett nytt lösenord till dig.<br>
Du kan byta detta lösenordet i "Redigera Profil" efter att du loggat in med det. </p>

 <form action="http://localhost/Herz/public/resetPassword/reset" method="post">
 {!! csrf_field() !!} 
 <div class="form-group">
 <label for="email">Email:</label> 
<input type="email" class="form-control" name="email">
 </div>
 
 <div class="form-group"> <label for="emailConfirm">Återge email:</label>
 <input name="emailConfirm" class="form-control" id="emailConfirm">
 </div> 

 <button type="submit" class="btn btn-default">Skicka</button> 
</form> 
@if(Session::has('message'))
<div class="alert alert-danger">
	{{ Session::get('message') }}
</div>
@endif
</div>
</div> 

</body>

</html>