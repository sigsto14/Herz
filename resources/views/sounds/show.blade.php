@extends('template')
@section('container')
@section('footer')
<!DOCTYPE HTML>
<?php

/* genererar en xml fil för att skicka till flashspelaren */

$sql= $sound;
$URL = $sound->URL;
$pic = $sound->podpicture;
echo $URL;
$str ='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<music>
<song url="' . $URL .'"/>

</music>';


$picStr = '<?xml version="1.0" encoding="utf-8"?>
<GALLERY COLUMNS="1" XPOSITION="30" YPOSITION="30" WIDTH="150" HEIGHT="150">
<IMAGE THUMB="' . $pic . '" />
</GALLERY>';
echo $str;

$file_name="list.xml"; // file name
$fp = fopen ($file_name, "w"); 

fwrite ($fp,$str); 
fclose ($fp); 
chmod($file_name,0777); 

$file_name2="gallery.xml"; // file name
$fp2 = fopen ($file_name2, "w"); 

fwrite ($fp2,$picStr); 
fclose ($fp2); 
chmod($file_name2,0777); 

?>

<title>{{ $sound->title }}</title>
<body>
@yield('content')
<!-- Kanal innehåll --> 
  <div class="container">
    <div class="col-md-12" id="container">
      <div class="podspelare">
        <div id="flashContent">
          <embed src="http://localhost/Herz/public/mp3_player/mp3_player.swf" style="width:600px;height:150px;">
        </div>
      </div>
      <div class="podmenu" >
       <ul>
          <li>
            <button name="submit" type="submit" class="btn btn-default btn-md">
            <span class=" glyphicon glyphicon-heart-empty" aria-hidden="true"></a></span>          
            </button>
          </li>
          <li>
            <button type="button" class="btn btn-default btn-md">
              <span class="glyphicon glyphicon-star" aria-hidden="true"></a></span>
            </button>
          </li>    
          <li id="podmenu-right">
            <button type="button" class="btn btn-default">
              <span class="glyphicon glyphicon-alert"></span>
            </button>        
          </li>        
          <li id="podmenu-right2">
            <td><p><span class="glyphicon glyphicon-heart">:000</span></p></td>
          </li>         
      </ul>
      </div>
      <div class="podinfo">
        <div class="podinfo-header">
          <h3>Podnamn - av Herz</h3>
        </div>
         <div class="podinfo-kat">
          <p>Kategori: Nyheter</p>
        </div>
        <div class="info">
          <h3>Beskrivning</h3>
          <div class="infobox">
          <p>Info om Podden</p>
          </div>
        </div>
        <div class="poddatum">
          <p>Uppladat: 2016-05-02</p>
        </div>
        <div class="podtaggar">
          <h5>Taggar:</h5>
          <p>pod, herz, etc, </p>
        </div>
      </div>
      <div class="addcomment">
        <div class="addcomment-box">
          <input type="comment" class="form-control" placeholder="Lägg till komment" name="comment"/>
        </div>
        <div class="addcomment-btn">
        <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
          Lägg till
          </button>
      </div>
      <div class="comment">
        <div class="panel panel-primary">
          <div class="panel-heading">Kommentarer</div>
          <div class="panel-body">
            <div class="commentbox">
                <ul>
                  <li class="well">
                <ul>
                  <li id="well-left" ><img src="http://localhost/Herz/public/images/Profilepictures/none.png"></li>
                  <li id="well-left">Användernamn</li>
                </ul>
               </li> 
              <div class="well2"><p>Komment jdkslajdkasjk kdjaksljdkljaskd kdjaksjdkjaskjk kdjsakjdksajkld kdjsakdjk kdjk kdjaksdj djakjdklaj jdkajdkasjklds jdaksjdkjkslaj jdkslajdkasjk kdjaksljdkljaskd kdjaksjdkjaskjk kdjsakjdksajkld kdjsakdjk kdjk kdjaksdj djakjdklaj jdkajdkasjklds jdaksjdkjkslaj</p>
              </div>
          </ul>
          </div>
                      <div class="commentbox2">
                <ul>
                  <li class="well">
                <ul>
                  <li id="well-left" ><img src="http://localhost/Herz/public/images/Profilepictures/none.png"></li>
                  <li id="well-left">Användernamn</li>
                </ul>
               </li> 
              <div class="well2"><p>Komment</p>
              </div>
          </ul>
          </div>
                      <div class="commentbox3">
                <ul>
                  <li class="well">
                <ul>
                  <li id="well-left" ><img src="http://localhost/Herz/public/images/Profilepictures/none.png"></li>
                  <li id="well-left">Användernamn</li>
                </ul>
               </li> 
              <div class="well2"><p>Komment</p>
              </div>
          </ul>
          </div> 
      </div>
      </div>

    </div>
  </div>
  </div>
  </div>
</body>
@stop