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


    <div class="inner-wrap">

{!! Form::open(array('route' => 'sound.store', 'files' => 'true')) !!}
    {!! csrf_field() !!}

    <!-- Namn på podcast -->
    <div>
        <label>Podcasttitel:</label>
        <input type="text" name="title" data-toggle="tooltip" title="Skriv ett namn på din podcast">
    </div>
    <!-- Val av taggar -->
    <div>
        <label>Tag:</label>
        <input type="text" name="tag" data-toggle="tooltip" title="Här kan du lägga till taggar till din podcast">
    </div>
    <!-- Beskrivning av podcast -->
    <div>
        <label>Beskrivning:</label>
        <textarea name="description" rows="10" data-toggle="tooltip" title="Här kan du lägga till en beskrivning av din podcast"></textarea>
    </div>
    <!-- Vem so kan se podcasten -->
    <div>
    	<label>Synlighet:</label>
      	<input type="radio" name="status" value="publik" checked data-toggle="tooltip" title="Alla kan se din podcast"><p style="margin-top: -10%" >Publik</p>
      	<input type="radio" name="status" value="privat" data-toggle="tooltip" title="Endast prenumeranter kan se din podcast"><p style="margin-top: -10%">Endast för prenumeranter</p>
    </div>

    <!-- Val av kategori -->
    <?php
    $categories = DB::table('category')->get();
    ?>
    <div>
    	<label>Kategori:</label>
    </div>
    <div class="catlabel">
    	<label>
    <select name="categoryID" data-toggle="tooltip" title="Välj vilken kategori din podcast ska hamna i">
    	@foreach($categories as $category)
    <option value="{{$category->categoryID}}">{{ $category->categoryname }}</option>

@endforeach
</label>
</select>
</div>

 <!-- uppladdningen tillåter bara bildfiler -->
<div>
	<label>Poddens bild:</label>
    <input type="file" name="image" accept="image/*" data-toggle="tooltip" title="Lägg till en bild till din podcast">
</div>

<div>
    <input type="hidden" name="channelID" value="{{ Auth::user()->userID }}">
</div>

 <!-- uppladdningen tillåter bara ljudfiler -->
<div>
	<label>Ljudklipp:</label>
	<input type="file" name="audio" accept="audio/*" data-toggle="tooltip" title="Välj vilket ljudklipp som ska laddas upp">
</div>


{!! Form::submit('Ladda upp!', array('class' => 'form-control btn')) !!}
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
</div>
@endif
</div>
</div>
</div>

<!-- Script för tooltips -->
<script>
	$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});
</script>

</body>
@stop