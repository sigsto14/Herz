
@extends('template')
@section('container')
@section('footer')

<!DOCTYPE HTML>

<body>
	@yield('content')
    <div class="container">
    <div class="col-md-3"></div>
	<div class="col-md-6" id="mini-container">
        <h1>Vad är Herz</h1>
        <div class="inner-wrap">
        <p>Herz är en plattform för dig med intresse för podcasts. På sidan kan du ladda upp eget material eller lyssna på andras.</p>
    </div>
    </div>
    </div>
</body>
