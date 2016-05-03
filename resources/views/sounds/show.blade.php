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
<!-- Sound show innehåll --> 
  <div class="container">
    <!-- hela vita boxen --> 
    <div class="col-md-12" id="container">
    <!--  Här börjar första kolumnen, här finns podspelare --> 
      <div class="col-md-6">
      <!--  Podspelare --> 
        <div class="podspelare"><!--  Gröna boxen omkring podspelare --> 
          <div class="podspelare2">
            <div id="flashContent">
              <embed src="http://localhost/Herz/public/mp3_player/mp3_player.swf" style="width:600px;height:150px;">
            </div>
          </div>
        </div>
        <!--  Podspelare slut--> 
        <!--  Podmenubar --> 
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
             <!--  Anmälning knappen --> 
              <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-alert"></span>
                </button>
                <div class="dropdown-menu">
                    <p>Anmäla</p>
                    <input type="anmal" class="form-control" placeholder="Värför vill du anmäla poden" name="anmal"/>
                </div>
              </div>
               <!--  Anmälning knappen slut -->      
             </li>
              <!--  Favorit mätare? den som visa hur måna favorit har poden -->         
             <li id="podmenu-right2">
                <td><p><span class="glyphicon glyphicon-heart">:000</span></p></td>
              </li>
              <!--  Favorit mätare slut -->            
            </ul>
          </div>
           <!--  Podmenubar slut --> 
            <!--  Podinfo box --> 
          <div class="podinfo">
            <div class="podinfo-header">
              <h3>Podnamn - av Herz</h3>
            </div>
            <div class="podinfo-kat">
              <p>Kategori: Nyheter</p>
            </div>
            <div class="info">
              <h4>Beskrivning:</h4>
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
         <!--  Podinfo box slut --> 
      </div>
         <!--  Första kolumnen slutar här -->
          <!--  Här börjar andra kolumnen -->  
      <div class="col-md-6" id="cmt-box">
      <!--  hela komment input boxen, med ram osv -->
        <div class="addcomment">
          <!--  input boxen -->
          <div class="addcomment-box">
            <input type="comment" class="form-control" placeholder="Lägg till komment" name="comment"/>
          </div>
          <!--  komment knappen -->
          <div class="addcomment-btn">
            <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Lägg till</button>
          </div>
        </div>
      <!--  komment input boxen slut -->
      <!--  Kommantarer börjar här -->
        <div class="comment">
          <div class="panel panel-primary">
            <div class="panel-heading">Kommentarer</div>          <!--  komment header -->
          <div class="panel-body"> <!--  boxen som innehåller kommentarer --> 
           <!--  1 st komment -->
            <div class="commentbox">
                <ul>
                  <li class="well">
                    <ul>
                              <!--  Använder information-->
                      <li id="well-left" ><img src="http://localhost/Herz/public/images/Profilepictures/none.png"></li>
                      <li id="well-left">Användernamn</li>
                      <li id="well-left-right">2016-05-03</li>
                    </ul>
                  </li> 
                  <!--  Komment -->
                  <div class="well2"><p>Komment jdkslajdkasjk kdjaksljdkljaskd kdjaksjdkjaskjk kdjsakjdksajkld kdjsakdjk kdjk kdjaksdj djakjdklaj jdkajdkasjklds jdaksjdkjkslaj jdkslajdkasjk kdjaksljdkljaskd kdjaksjdkjaskjk kdjsakjdksajkld kdjsakdjk kdjk kdjaksdj djakjdklaj jdkajdkasjklds jdaksjdkjkslaj</p>
                  </div>
                </ul>
              </div>
              <!--  1 st komment slut -->
            <div class="commentbox2">
                <ul>
                  <li class="well">
                    <ul>
                              <!--  Använder information-->
                      <li id="well-left" ><img src="http://localhost/Herz/public/images/Profilepictures/none.png"></li>
                      <li id="well-left">Användernamn</li>
                      <li id="well-left-right">2016-05-03</li>
                    </ul>
                  </li> 
                  <!--  Komment -->
                  <div class="well2"><p>Komment </p>
                  </div>
                </ul>
              </div> 
            <div class="commentbox3">
                <ul>
                  <li class="well">
                    <ul>
                              <!--  Använder information-->
                      <li id="well-left" ><img src="http://localhost/Herz/public/images/Profilepictures/none.png"></li>
                      <li id="well-left">Användernamn</li>
                      <li id="well-left-right">2016-05-03</li>
                    </ul>
                  </li> 
                  <!--  Komment -->
                  <div class="well2"><p>Komment </p>
                  </div>
                </ul>
              </div>
            <div class="commentbox4">
                <ul>
                  <li class="well">
                    <ul>
                              <!--  Använder information-->
                      <li id="well-left" ><img src="http://localhost/Herz/public/images/Profilepictures/none.png"></li>
                      <li id="well-left">Användernamn</li>
                      <li id="well-left-right">2016-05-03</li>
                    </ul>
                  </li> 
                  <!--  Komment -->
                  <div class="well2"><p>Komment</p>
                  </div>
                </ul>
              </div>
            <div class="commentbox5">
                <ul>
                  <li class="well">
                    <ul>
                              <!--  Använder information-->
                      <li id="well-left" ><img src="http://localhost/Herz/public/images/Profilepictures/none.png"></li>
                      <li id="well-left">Användernamn</li>
                      <li id="well-left-right">2016-05-03</li>
                    </ul>
                  </li> 
                  <!--  Komment -->
                  <div class="well2"><p>Komment</p>
                  </div>
                </ul>
              </div><!--  commentbox 5 slut -->                                                                  
            </div><!--  Panel-body slut-->
          </div><!--  div comment slut -->
      </div><!--  Andra Kolumnen slut -->
    </div><!--  col-md-12 slut -->
  </div><!--  container slut -->
</div><!--  div som vi behöver att footer hamnar rätt -->
</body>
@stop