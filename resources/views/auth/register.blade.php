@extends('template')
@section('container')
@section('footer')
<div class="container">
<div class="col-md-3"></div>
<div class="col-md-6" id="mini-container">

<h1>Registera Dig</h1>

@if(Auth::check())

{!!     Form::model($user, array('route' => array('user.update', $user->userID), 'files' => 'true', 'method' => 'PUT')) !!}
    {!! csrf_field() !!}
{!! Form::label('Profilbild:') !!}
{!! Form::file('image', null) !!}

{!! Form::submit('Save', '', array('class' => 'form-control')) !!}
{!! Form::close() !!}

<div>
        <input type="hidden" name="username" value="{{ Auth::user()->username }}">
</div>

<div>
        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
</div>


@else


    <div class="inner-wrap">
<form method="POST" action="../auth/register">

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




        <button type="submit" class="btn">Registrera dig</button>


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