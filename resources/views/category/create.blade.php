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
@if(Auth::check())<!--kollar så inloggad -->
<div class="section">Kategorier</div>
    <div class="inner-wrap">
<!-- php-kod för att kunna kolla om den som är inlogad är admin-->
<?php
//användare
$username = Auth::user()->username;
// hämtar kategorier
$categories = DB::table('category')->orderBy('categoryname', 'asc')->get();
?>
<!-- kollar så inloggad användare är Herzteam (adminkonto) -->
@if($username == 'Herzteam')

<!-- ett formulär för att lägga till kategori -->
<td>{!! Form::open(array('route' => 'category.store')) !!}
 {!! csrf_field() !!}

<input type="text" name="categoryname" value="Kategorinamn">
{!! Form::submit('Lägg till kategori',  array('class' => 'form-control btn')) !!}
{!! Form::close() !!}</td><br>

</div>

<div class="section">Nuvarande kategorier</div>
<div class="inner-wrap">
<!-- formulär för att ta bort kategorier -->
{!!   Form::open(array('method' => 'DELETE', 'route' => array('category.destroy'))) !!}
<div class="catlabel">
<label>
     <select name="categoryID">
 <!-- foreach loop för kategorier, för att få var category i select -->
@foreach($categories as $category)
  <option value="{{$category->categoryID}}"><p>{{ $category->categoryname }}</p></option>
@endforeach
</select>
</label>
</div>
</td>
<br>
<br>

{!! Form::submit('Ta Bort', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort kategorin?");' )) !!}
{!! Form::close() !!}
@endif <!-- slut på check användare är admin -->

<!-- printar feedbacken från controller -->
@if(Session::has('message'))
   <div class="admin-feedback">
     <p>
	{{ Session::get('message') }}
	</p>
   </div>
@endif<!-- slut på message koll-->
@endif<!-- slut på auth check -->
				
</tr>
</table>
</div>
</div>			 
</div>


</body>
@stop