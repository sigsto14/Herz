@extends('template')
@section('container')
@section('footer')
<!-- skapa spellista formulär -->
<body>
   <div class="container">
    <div class="col-md-12" id="container">
<td>{!! Form::open(array('route' => 'playlist.store')) !!}
 {!! csrf_field() !!}
<div>
        <input type="hidden" name="userID" value="{{ Auth::user()->userID }}">
</div>
{!! Form::label('Spellisttitel:') !!}
{!! Form::text('listTitle') !!}<br>
{!! Form::label('Spellistbeskrivning:') !!}
{!! Form::text('listDescription') !!}<br>
<button name="submit" type="submit" class="btn btn-default btn-md">
              Lägg till spellista 
              </button>

</div> 
</div>


{!! Form::close() !!}



</body>
@stop