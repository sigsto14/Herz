@extends('template')
@section('container')
@section('footer')
<head>
 <link href="http://localhost/Herz/public/css/form.css" rel="stylesheet">

<title>Edit Profile</title>
</head>
<div class="container">
<div class="col-md-12"id="container">
<br><br><br><br><br><br><br><br><br><br><br>
<table class="table">
@if(Auth::check())
@if(Auth::user()->userID == $user->userID)
{{-- formulär som även visar den data som är i databasen, för ändringar i users och channels tabeller--}}
{!!     Form::model($user, array('route' => array('user.update', $user->userID), 'files' => 'true', 'method' => 'PUT')) !!}
{!! csrf_field() !!}
{!!     Form::label('username', 'Username:') !!}
{!!     Form::text('username') !!}<br>




{!!     Form::label('email', 'Email:') !!}
{!!     Form::text('email') !!}<br>


<img src="{{ $user->profilePicture }}" style="width:145px;height:159px;"/><br>
{!! Form::label('Profilbild') !!}
{!! Form::file('image', null) !!}<br>


</table>

<input type="submit" class="btn" value="Uppdatera">

<br>
{!!     Form::close() !!}<br><br>
<br>
<br>

@if(Session::has('message'))
<div class="alert alert-success">
	{{ Session::get('message') }}
</div>
@endif
@if(Session::has('message1'))
<div class="alert alert-danger">
	{{ Session::get('message1') }}
</div>
@endif
<button type="button" id="changePass" class="btn btn-success">Byt Lösenord</button>
<form action="http://localhost/Herz/public/user/resetPass" method="POST">
{!! csrf_field() !!}
<div id="newPass" class="hidden">
<label>Nytt lösenord</label><input type="password" id="newPass" name="newPass"><br>

{!!     Form::label('newPassConfirm', 'Upprepa Nytt Lösenord:') !!}
{!!     Form::password('newPassConfirm') !!}<br>

{!!     Form::label('activeConfirm', 'Nuvarande Lösenord:') !!}
{!!     Form::password('activeConfirm') !!}<br>
<input type="submit" class="btn" value="Byt lösenord">
</div>

{!!     Form::close() !!}
 <script>
$('#changePass').click(function(){
  $("#newPass").toggleClass("hidden");
  

});
</script>
@if(Session::has('message3'))
<div class="alert alert-success">
	{{ Session::get('message3') }}
</div>
@endif
@if(Session::has('message4'))
<div class="alert alert-danger">
	{{ Session::get('message4') }}
</div>
@endif

{!! Form::open(array('method' => 'DELETE', 'route' => array('user.destroy', $user->userID))) !!}

	{!! Form::submit('Ta bort konto', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Är du säker på att du vill ta bort ditt konto?");')) !!}
{!!     Form::close() !!}



@else
<h4>Du har ej behörighet att vara här!!</h4>
@endif
@endif







</div>
</div>

</div>
@stop
