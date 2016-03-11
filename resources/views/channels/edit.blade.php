@extends('template')
@section('container')
@section('footer')
<title>Edit Profile</title>
<div class="container">
<div class="col-md-12" id="container">
<br><br><br><br><br>
<!-- kör <br> sålänge för att kunna se -->

<table class="table">
@if(Auth::user()->userID == $channel->userID)

{{-- formulär som även visar den data som är i databasen --}}
{!!     Form::model($channel, array('route' => array('channel.update', $channel->channelID), 'method' => 'PUT')) !!}

    {!! csrf_field() !!}<br>

{!!     Form::label('channelname', 'Kanalnamn:') !!}
{!!     Form::text('channelname') !!}<br>
{!!     Form::label('information', 'Information:') !!}
{!!     Form::textarea('information') !!}<br>




{!!     Form::submit('Ändra kontoinformation') !!}<br>

{!!     Form::close() !!}<br><br><br>




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
</div>


@stop