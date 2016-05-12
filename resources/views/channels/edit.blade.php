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

<!-- Script för tooltips -->
<script>
	$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});
</script>

@stop