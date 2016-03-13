@extends('template')

@section('container')

<!DOCTYPE HTML>

<title>Users</title>

<body>



<div class="container">
<div class="col-md-12" id="container"><br><br>
<p class="titles">Users:</p>
<table class="table">

<th>Username</th>
<th>Email</th>
<th>Information</th></tr>


<?php
 $channels = DB::table('channels')->join('users', 'users.userID', '=', 'channels.channelID')->get();
?>
			
			
			@foreach($channels as $channel)
			<tr>	
			<td><a href="http://localhost/Herz/public/channel/{{ $channel->channelID }}">{{ $channel->channelname }}</a></td>
			<td>{{ $channel->information }}</td>

		
				@endforeach
			
			
				
				</tr>
			
</table>

</div>			 
	</div>


</body>
@stop