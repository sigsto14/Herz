<!DOCTYPE HTML>
@include('template');
<html>
<head>
</head>

<body>
<div class="container">
<div class="col-md-12"id="container">

<p> Skriv din registrerade email i fälten nedan så skickar Herz ett nytt lösenord till dig.<br>
Du kan byta detta lösenordet i "Redigera Profil" efter att du loggat in med det. </p>
<form action="http://localhost/Herz/public/resetPassword/reset" method="post" accept-charset="UTF-8">
{!! csrf_field() !!}
{!!     Form::label('email', 'Email:') !!}
{!!     Form::text('email') !!}<br>

{!!     Form::label('emailConfirm', 'Upprepa Email:') !!}
{!!     Form::text('emailConfirm') !!}<br>



 <input type="submit" id="changePass" class="btn btn-success" value="Skicka">
{!! Form::close() !!}
@if(Session::has('message1'))
<div class="alert alert-danger">
	{{ Session::get('message1') }}
</div>
@endif

</div>



</body>

</html>