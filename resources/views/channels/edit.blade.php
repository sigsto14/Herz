@extends('template')
@section('container')
@section('footer')
<title>Edit Profile</title>
<div class="container">
<div class="col-md-3"></div>
<div class="col-md-6" id="mini-container">


<h1>Redigera Kanal</h1>

<div class="section">Redigera Kanal</div>
    <div class="inner-wrap">
@if(Auth::check())
@if(Auth::user()->userID == $channel->userID)

{{-- formulär som även visar den data som är i databasen --}}
{!!     Form::model($channel, array('route' => array('channel.update', $channel->channelID), 'method' => 'PUT')) !!}

    {!! csrf_field() !!}

{!!     Form::label('channelname', 'Kanalnamn:') !!}
{!!     Form::text('channelname') !!}
{!!     Form::label('information', 'Information:') !!}
{!!     Form::textarea('information') !!}




{!!     Form::submit('Ändra kontoinformation', array('class' => 'btn')) !!}

{!!     Form::close() !!}




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

@if(Session::has('message1'))
<div class="alert alert-danger">
	{{ Session::get('message1') }}
</div>
@endif

@endif


</div>
</div>

</div>
</div>
</div>
</div>


@stop