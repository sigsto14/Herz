@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<title>Users</title>

<body>

@yield('content')


<div class="container">
<div class="col-md-12" id="container">
<div class="redigering">


<!-- PHP för att hämta ut ljudklippen och kunna hämta vem som laddat upp och annan info -->
		
	
			<!-- gör en foreach, så att vi drar ut var klipp och kör dess info enskilt i en tabell -->
			
@if(Auth::check())
<!-- php-kod för att kunna kolla om den som är inlogad är admin-->
<?php
$username = Auth::user()->username;
?>
<h2>Kategorier</h2>

<!-- ett formulär för att lägga till kategori -->
@if($username == 'Herzteam')
<td>{!! Form::open(array('route' => 'category.store')) !!}
 {!! csrf_field() !!}

<input type="text" name="categoryname" value="Kategorinamn">
{!! Form::submit('Lägg till kategori', '', array('class' => 'form-control')) !!}
{!! Form::close() !!}</td><br>

<td><h1>Nuvarande kategorier</h1>
<?PHP
$categories = DB::table('category')->orderBy('categoryname', 'asc')->get();
?>

 {!!   Form::open(array('method' => 'DELETE', 'route' => array('category.destroy'))) !!}

     <select name="categoryID">
         @foreach($categories as $category)
 <option value="{{$category->categoryID}}">{{ $category->categoryname }}</option>

@endforeach
</select>
</td>

{!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort kategorin?");' )) !!}
{!! Form::close() !!}
@endif

@if(Session::has('message'))
<div class="admin-feedback">
<p>
	{{ Session::get('message') }}
	</p>
</div>
@endif

@endif
<!-- formuläret syns bra om man är inloggad -->

			
			
				
				</tr>
			
</table>

</div>
</div>			 
	





</div>


</body>
@stop