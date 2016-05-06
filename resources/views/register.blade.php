@extends('template')
@section('container')
@section('footer')
<div class="container">
<div class="col-md-3"></div>
<div class="col-md-6" id="mini-container">



@if(Auth::check())
<h1>Du är redan medlem!</h1>
@else
<h1>Registera Dig</h1>

    <div class="inner-wrap">
<form method="POST" action="http://localhost/Herz/public/auth/register">

    {!! csrf_field() !!}
<div>
        <input type="hidden" name="profilePicture" value="http://localhost/Herz/public/images/profilepictures/none.png">
    </div>
   

    <div>
        <label>Användarnamn:</label>
        <input type="text" name="username" value="{{ old('username') }}">
    </div>

    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}">
    </div>



 <div>
        <label>Lösenord:</label>
        <input type="password" name="password">
    </div>

    <div>
        <label>Bekräfta lösenordet:</label>
        <input type="password" name="password_confirmation">




        <button type="submit" class="btn" style="  
  border: none;
  font-size: 16px;
  height: auto;
  margin: 0;
  outline: 0;
  padding: 15px;
  width: 100%;
   margin-bottom: 30px;">Registrera dig</button>


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
@endif



</div>
</form>
</div>
</form>
</div>
</div>
</div>
@stop