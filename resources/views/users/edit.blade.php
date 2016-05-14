@extends('template')
@section('container')
@section('footer')
<head>
 <link href="http://localhost/Herz/public/css/form.css" rel="stylesheet">

<title>Edit Profile</title>
</head>
<div class="container">
<div class="col-md-3"></div>
<div class="col-md-6" id="mini-container">


<h1>Redigera Profil</h1>

@if(Auth::check())
<div class="section">Redigera Info</div>
    <div class="inner-wrap">


@if(Auth::user()->userID == $user->userID)
{{-- formulär som även visar den data som är i databasen, för ändringar i users och channels tabeller--}}
{!!     Form::model($user, array('route' => array('user.update', $user->userID), 'files' => 'true', 'method' => 'PUT')) !!}
{!! csrf_field() !!}
<!-- Redigering av användarnamn -->
<div>
    <label>Användarnamn:</label>
    <input type="text" name="username" data-toggle="tooltip" title="Ditt användarnamn får bestå av max 10 tecken">
</div>
<!-- Redigering av E-post adress -->
<div>
   <label>Email:</label>
   <input type="email" name="email" data-toggle="tooltip" title="Du måste ange en giltig e-postadress">
</div>
<!-- Val av Profilbild -->
<div>
	<label>Profilbild:</label>
	<img src="{{ $user->profilePicture }}"/>
    <input type="file" name="image" accept="image/*" data-toggle="tooltip" title="Välj en bild som ska visas på din profil">
</div>

<input type="submit" class="btn" value="Uppdatera">


{!!     Form::close() !!}


</div>

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
<div class="section">Byt Lösenord</div>
    <div class="inner-wrap">

<form action="http://localhost/Herz/public/user/resetPass" method="POST">
{!! csrf_field() !!}
<div id="newPass">
	<!-- Kod för nytt lösenord -->	
	<div>
		<label>Nytt lösenord:</label>
		<input type="password" name="newPass" id="newPass" data-toggle="tooltip" title="Skriv in ditt nya lösenord, det måste innehålla minst 6 tecken">
	</div>
	<!-- Upprepa nytt lösenord -->
	<div>
		<label>Upprepa Nytt lösenord:</label>
		<input type="password" name="newPassConfirm" id="newPass" data-toggle="tooltip" title="Upprepa ditt nya lösenord">
	</div>
	<!-- Nuvaranade lösenord -->
	<div>
		<label>Nuvarande Lösenord:</label>
		<input type="password" name="activeConfirm" data-toggle="tooltip" title="Skriv in ditt nuvarande lösenord">
	</div>
<input type="submit" class="btn" value="Byt lösenord">
</div>

{!!     Form::close() !!}
</div>
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

<div class="section">Radera konton</div>
    <div class="inner-wrap">

{!! Form::open(array('method' => 'DELETE', 'route' => array('user.destroy', $user->userID))) !!}

	{!! Form::submit('Ta bort konto', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Är du säker på att du vill ta bort ditt konto?");')) !!}
{!!     Form::close() !!}

</div>


@else
<h4>Du har ej behörighet att vara här!!</h4>
@endif
@endif



<!-- Script för tooltips -->
<script>
	$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});
</script>



</div>
</div>

</div>
@stop
