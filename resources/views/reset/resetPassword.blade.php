<!DOCTYPE HTML>
@extends('template');
<html>
<head>
</head>

<body>
<!-- formulär för att kunna återställa lösenord med hjälp av emailadress -->
<div class="container">
<div class="col-md-3"></div>
<div class="col-md-6" id="mini-container">
<h1>Glömt Lösenord</h1>


<div class="section">Skriv din registrerade email i fälten nedan så skickar Herz ett nytt lösenord till dig.Du kan byta detta lösenordet i "Redigera Profil" efter att du loggat in med det.</div>
    <div class="inner-wrap">
 <form action="http://localhost/Herz/public/resetPassword/reset" method="post">
 {!! csrf_field() !!} 
 <div class="form-group">
 <label for="email">Email:</label> 
<input type="email" class="form-control" name="email">
 </div>
 
 <div class="form-group"> <label for="emailConfirm">Återge email:</label>
 <input name="emailConfirm" class="form-control" id="emailConfirm">
 </div> 

 <button type="submit" class="btn btn-default">Skicka nytt lösenord</button> 
</form> 
@if(Session::has('message'))
<div class="alert alert-danger">
	{{ Session::get('message') }}
</div>
@endif
</div>
</div>
</div>


</body>

</html>