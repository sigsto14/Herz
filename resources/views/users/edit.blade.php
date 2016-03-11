@extends('template')
@section('container')
@section('footer')
<head>
 <link href="http://localhost/Herz/public/css/form.css" rel="stylesheet">

<title>Edit Profile</title>
</head>
<div class="container">
<div class="col-md-12"id="container">
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<table class="table">
@if(Auth::user()->id == $user->id)
{{-- formulär som även visar den data som är i databasen, för ändringar i users och channels tabeller--}}
{!!     Form::model($user, array('route' => array('user.update', $user->userID), 'files' => 'true', 'method' => 'PUT')) !!}

{!!     Form::label('username', 'Username:') !!}
{!!     Form::text('username') !!}<br>




{!!     Form::label('email', 'Email:') !!}
{!!     Form::text('email') !!}<br>


<img src="{{ $user->profilePicture }}" style="width:145px;height:159px;"/><br>
{!! Form::label('Profilbild') !!}
{!! Form::file('image', null) !!}



</table>


<input type="submit" class="button2" value="Submit">

{!!     Form::close() !!}<br><br><br>

<script>
$('.button2').click(function(){
    $('.button1').trigger('click');
})
</script>

@else
<a class="dropdown-toggle" href="http://localhost/TradeArt/public/auth/login" data-toggle="dropdown">Log in</a> or <a href="http://localhost/TradeArt/public/auth/register">Sign up</a> to upload pictures!
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

@if(Session::has('message'))
<div class="alert alert-success">
	{{ Session::get('message') }}
</div>
@endif




</div>
</div>

</div>
@stop
