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
           <input type="text" name="username" value="{{ old('username') }}" data-toggle="tooltip" title="Ditt användarnamn får bestå av max 10 tecken">
       </div>

       <div>
           <label>Email:</label>
           <input type="email" name="email" value="{{ old('email') }}" data-toggle="tooltip" title="Du måste ange en giltig e-postadress">
       </div>



    <div>
           <label>Lösenord:</label>
           <input type="password" name="password" data-toggle="tooltip" title="Ditt lösenord måste bestå av minst 6 tecken">
       </div>

       <div>
           <label>Bekräfta lösenordet:</label>
           <input type="password" name="password_confirmation"  data-toggle="tooltip" title="Bekräfta ditt lösenord">




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

<!-- Script för tooltips -->
<script>
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

</div>
</form>
</div>
</form>
</div>
</div>
</div>
@stop