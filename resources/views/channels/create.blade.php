@extends('template')
@section('container')
@section('footer')
<head>
<title>Ladda upp ljud</title>

</head>
<body>

    <br><br><br><br><br><br>
    <div class="container">
<div class="col-md-12" id="container">
    <h2> För att ladda upp ljudklipp får du först skapa en kanal! </h2>
@if(Auth::check())
<title>Skapa kanal</title>


{!! Form::open(array('route' => 'channel.store', 'files' => 'true')) !!}
    {!! csrf_field() !!}

{!! Form::label('Kanalnamn:') !!}
{!! Form::text('channelname') !!}<br>

{!! Form::label('Information om kanalen:') !!}
{!! Form::textarea('information') !!}<br>




{!! Form::submit('Save', '', array('class' => 'form-control')) !!}
{!! Form::close() !!}


@else
<a class="dropdown-toggle" href="http://localhost/Herz/public/auth/login" data-toggle="dropdown">Logga in</a> eller <a href="http://localhost/Herz/public/auth/register">Registrera dig</a> för att skapa kanal!
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
</body>
@stop