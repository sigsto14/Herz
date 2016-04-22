@extends('template')
@section('container')
@section('footer')
<head>

</head>
 <?php
              /* ska ta fram existerande spellistor för användaren */

               $listID= '1';
             $arr = array();
             $lists = DB::table('playlists')->where('listID', '=', $listID)->first(); 


  
 $listItems = array_values(explode(',',$lists->soundIDs,13));


  
              ?>

<body>
  <div class="container">
    <div class="col-md-12" id="container">
@foreach($listItems as $listItem)

<?php

$sounds = DB::table('sounds')->where('soundID', '=', $listItem)->get();
?>

    @foreach($sounds as $sound)
              <p>{{ $sound->title }}</p>
              @endforeach
@endforeach
</div>
</div>
</body>

@stop