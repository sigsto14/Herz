@extends('template')
@section('container')
@section('footer')
<head>
<title>Ladda upp ljud</title>

</head>
<body>

    <br><br><br><br><br><br>
@if(Auth::check())
<title>Ladda upp podcast</title>
<div class="container">
<div class="col-md-12">

{!! Form::open(array('route' => 'sound.store', 'files' => 'true')) !!}
    {!! csrf_field() !!}

{!! Form::label('Podcasttitel:') !!}
{!! Form::text('title') !!}<br>

{!! Form::label('Tag:') !!}
{!! Form::text('tag') !!}<br>

<?php
$categories = DB::table('category')->get();
?>
{!! Form::label('Kategori:') !!}
 <select name="categoryID">
         @foreach($categories as $category)
 <option value="{{$category->categoryID}}">{{ $category->categoryname }}</option>

@endforeach
</select>
<br>

{!! Form::label('Poddens bild:') !!}
{!! Form::file('image', null) !!}<br>
<div>
        <input type="hidden" name="channelID" value="{{ Auth::user()->userID }}">
</div>
 {!! Form::label('Ljudklipp:') !!}
 <!-- uppladdningen tillåter bara ljudfiler -->
<input type="file" name="audio" accept="audio/*"><br>

{!! Form::submit('Save', '', array('class' => 'form-control')) !!}
{!! Form::close() !!}


@else
<a class="dropdown-toggle" href="http://localhost/Herz/public/auth/login" data-toggle="dropdown">Logga in</a> eller <a href="http://localhost/Herz/public/auth/register">Registrera dig</a> för att ladda upp podcasts!
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
</body>
@stop