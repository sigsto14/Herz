@extends('template')
@section('container')
@section('footer')
<head>
<title>Ladda upp ljud</title>

</head>
<body>


@if(Auth::check())
<title>Ladda upp podcast</title>
<div class="container">
<div class="col-md-3"></div>
<div class="col-md-6" id="mini-container">


<h1>Ladda Upp Podcast</h1>

<div class="section">Redigera Info</div>
    <div class="inner-wrap">

{!! Form::open(array('route' => 'sound.store', 'files' => 'true')) !!}
    {!! csrf_field() !!}

{!! Form::label('Podcasttitel:') !!}
{!! Form::text('title') !!}<br>

{!! Form::label('Tag:') !!}
{!! Form::text('tag') !!}<br>
{!! Form::label('Beskrivning:') !!}
{!! Form::textarea('description') !!}<br>

{!! Form::label('Synlighet:') !!}<br>

  <input type="radio" name="status" value="publik" checked>Publik<br>
  <input type="radio" name="status" value="privat">Endast för prenumeranter<br><br>

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

{!! Form::submit('Ladda upp!', '', array('class' => 'form-control')) !!}
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
</div>
</body>
@stop