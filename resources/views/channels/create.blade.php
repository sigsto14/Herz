@extends('template')
@section('container')
@section('footer')
<head>
<title>Ladda upp ljud</title>

</head>
<body>


<div class="container">
<div class="col-md-3"></div>
<div class="col-md-6" id="mini-container">


<h1>OBS!!!</h1>
    
<div class="section"> För att ladda upp ljudklipp får du först skapa en kanal! </h3></div>
<div class="inner-wrap">
@if(Auth::check())



{!! Form::open(array('route' => 'channel.store', 'files' => 'true')) !!}
    {!! csrf_field() !!}

    <!-- Kanalnamn -->
    <div>
        <label>Kanalnamn:</label>
        <input type="text" name="channelname" data-toggle="tooltip" title="Välj ett namn för din kanal">
    </div>
    <!-- Information om kanal -->
    <div>
        <label>Information:</label>
        <textarea name="information" rows="10" data-toggle="tooltip" title="Här kan du lägga till information om din kanal"></textarea>
    </div>





{!! Form::submit('Skapa Kanal',  array('class' => 'form-control btn')) !!}
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
</div>

<!-- Script för tooltips -->
<script>
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>


</body>
@stop