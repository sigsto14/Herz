@extends('template')

@section('container')

<!DOCTYPE HTML>

<title>Users</title>

<body>



<div class="container">
<div class="col-md-12" id="container">
<h3>Users:</h3>
<table class="table">

<th>Username</th>
<th>Email</th>
</tr>



			
			
			@foreach($users as $user)
			<tr>	
			<td><a href="http://localhost/Herz/public/user/{{ $user->userID }}">{{ $user->username }}</a></td>
			<td>{{ $user->email }}</td>

		
				@endforeach
			
			
				
				</tr>
			
</table>

</div>			 
	</div>


</body>
@stop