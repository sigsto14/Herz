@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<title>Users</title>

<body>

@yield('content')


<div class="container">
<div class="col-md-3"></div>
<div class="col-md-6" id="mini-container">

<h1>Administrera Kategorier</h1>


<!-- PHP för att hämta ut ljudklippen och kunna hämta vem som laddat upp och annan info -->
		
	
			<!-- gör en foreach, så att vi drar ut var klipp och kör dess info enskilt i en tabell -->
			
@if(Auth::check())
<div class="section">Kategorier</div>
    <div class="inner-wrap">
<!-- php-kod för att kunna kolla om den som är inlogad är admin-->
<?php
$username = Auth::user()->username;
?>

<!-- ett formulär för att lägga till kategori -->
@if($username == 'Herzteam')
<td>{!! Form::open(array('route' => 'category.store')) !!}
 {!! csrf_field() !!}

<input type="text" name="categoryname" value="Kategorinamn">
{!! Form::submit('Lägg till kategori',  array('class' => 'form-control btn')) !!}
{!! Form::close() !!}</td><br>

</div>

<div class="section">Nuvarande kategorier</div>
    <div class="inner-wrap">
<?PHP
$categories = DB::table('category')->orderBy('categoryname', 'asc')->get();
?>

 {!!   Form::open(array('method' => 'DELETE', 'route' => array('category.destroy'))) !!}

<label>
     <select name="categoryID">
         @foreach($categories as $category)
 <option value="{{$category->categoryID}}"><p>{{ $category->categoryname }}</p></option>

@endforeach
</select>
</label>
</td>
<br>
<br>

{!! Form::submit('Ta Bort', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort kategorin?");' )) !!}
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