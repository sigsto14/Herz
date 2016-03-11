@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<title>Users</title>

<body>

@yield('content')


<div class="container">
<div class="col-md-12" id="back"><br><br>

<table class="table">
<br><br><br><br>

<!-- PHP för att hämta ut ljudklippen och kunna hämta vem som laddat upp och annan info -->
			<?PHP
$categories = DB::table('category')->orderBy('categoryname', 'asc')->get();
?>
	
			<!-- gör en foreach, så att vi drar ut var klipp och kör dess info enskilt i en tabell -->
		<select name="categoryID">
         @foreach($categories as $category)
 <option value="{{$category->categoryID}}">{{ $category->categoryname }}</option>

@endforeach
</select>
			
</table>

</div>			 
	





</div>


</body>
@stop