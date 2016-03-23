@extends('template')
@section('container')
@section('footer')
<div class="container">
<div class="col-md-12" id="container">
<div class="redigering">
@if(Auth::check())
{!!     Form::model($user, array('route' => array('user.update', $user->userID), 'files' => 'true', 'method' => 'PUT')) !!}
    {!! csrf_field() !!}
{!! Form::label('Profilbild:') !!}
{!! Form::file('image', null) !!}<br>

{!! Form::submit('Save', '', array('class' => 'form-control')) !!}
{!! Form::close() !!}

<div>
        <input type="hidden" name="username" value="{{ Auth::user()->username }}">
</div>

<div>
        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
</div>


@else


<form method="POST" action="../auth/register">

    {!! csrf_field() !!}
<div>
        <input type="hidden" name="profilePicture" value="http://localhost/Herz/public/images/profilepictures/none.png">
    </div>
   

    <div>
        Username
        <input type="text" name="username" value="{{ old('username') }}">
    </div>

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>



 <div>
        <label>Password:</label>
        <input type="password" name="password">
    </div>

    <div>
        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation">




    <div>
        <button type="submit">Register</button>
    </div>

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