
<title>Edit Profile</title>
<div class="container">
<div class="col-md-12">

<table class="table">
@if(Auth::user()->id == $user->id)
{{-- formulär som även visar den data som är i databasen --}}
{!!     Form::model($user, array('route' => array('channel.update', $user->userID), 'files' => 'true', 'method' => 'PUT')) !!}

    {!! csrf_field() !!}<br>

{!!     Form::label('information', 'Information:') !!}
{!!     Form::text('information') !!}<br>




{!!     Form::label('channelname', 'Kanalnamn:') !!}
{!!     Form::text('channelname') !!}<br>
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


