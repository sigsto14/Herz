@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>
<?php
$favorites = DB::table('favorites')->join('sounds', 'favorites.soundID', '=', 'sounds.soundID')->join('users', 'users.userID', '=', 'favorites.userID')->get();

?>

<br><br><br><br><br><br>
<body>
@yield('content')
<!-- Kanal innehåll --> 
    <div class="container">
    <!-- Kanal header --> 
            
    
        
          @if(Auth::user())

@endif
    
        </div>
         <!-- Andra lådan, här fins podar -->
   
			



</body>
@stop