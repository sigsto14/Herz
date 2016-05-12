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


        
        /* id för kanalen så att det kan hämtas mer info */  $id = $sound->channelID;
        /*kanalinfo*/  $channel = DB::table('channels')->where('channels.channelID', '=', $id)->first();
        /* user som gjort klippet */  $user = DB::table('users')->where('users.userID', '=', $id)->first();
    /* kommentarerna på klippet */      $comments = DB::table('comments')->join('users', 'users.userID', '=', 'comments.userID')->where('soundID', '=', $sound->soundID)->orderBy('comments.created_at', 'DESC')->get();
     /* för att kolla om nulll */      $commentsCheck = DB::table('comments')->join('users', 'users.userID', '=', 'comments.userID')->where('soundID', '=', $sound->soundID)->first();
      /*för att hämta kategorinamn */    $category = DB::table('category')->where('categoryID', '=', $sound->categoryID)->first();
      /* hämtar ut tiden klippet laddades upp */  $uploaded= substr($category->created_at, 0, 10);
       /* hur många som har klippet som favorit*/       $favNr = DB::table('favorites')->where('soundID', '=', $sound->soundID)->count();

if(Auth::check()){
               $lists = DB::table('playlists')->where('userID', '=', Auth::user()->userID)->get();
        $listCheck = DB::table('playlists')->where('userID', '=', Auth::user()->userID)->first();
        $userID = Auth::user()->userID;
        $soundID = $sound->soundID;
        $mysqli = new mysqli("localhost","root","","herz");
        $query = <<<END
        SELECT * FROM favorites
        WHERE userID = '{$userID}'
        AND soundID = '{$soundID}'
END;
        $res = $mysqli->query($query);
        if($res->num_rows > 0){
        $state = 1;
        }
        else {
        $state = 0;
        }
        // php för o kolla om användaren redan prenumererar på kanalen:
$channelID = $sound->channelID;
$prenCheckQ = <<<END
SELECT * FROM subscribe
WHERE userID = '{$userID}'
AND channelID = '{$channelID}'
END;
$prenCheckG = $mysqli->query($prenCheckQ);
if($prenCheckG->num_rows >0){
  $pren = 'true';
}
else {
  $pren = 'false';
}
}



?>

<title>{{ $sound->title }}</title>
<body>
<!-- Facebook JS -->  

@yield('content')
<!-- Sound show innehåll --> 
  <div class="container">
    <!-- hela vita boxen --> 
    <div class="col-md-12" id="container">
    <!--  Här börjar första kolumnen, här finns podspelare --> 
      <div class="col-md-6">
      <!--  Podspelare --> 

        <div class="podspelare"><!--  Gröna boxen omkring podspelare --> 
         <div id="feedback"></div>
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
           <!--  prenumerera knapp --> 
                   @if(Auth::check())
           @if($pren == 'false')
            <button type="button" id="pren" tooltip="Prenumerera" class="knp knp-7 knp-7e knp-icon-only icon-eye2">Like</button>
            @else 
                  <button type="button" id="pren" tooltip="Sluta prenumerera" class="knp knp-7 knp-7e knp-icon-only icon-eye2b">Like</button>
                  @endif
           <input type="hidden" name="userID" id="userID" value="{{ $userID }}" >
              <input type="hidden" name="channelID" id="channelID" value="{{ $channelID }}" >
          </li>
            <li>

        <!-- php-kod för att kolla om det redan är favorit. Det fungerar ej med eloquent så vanlig sql/php löser problemet -->

   
         @if($state == 0)
  
         
            <button id="favAdd" tooltip="Favorit" class="knp knp-7 knp-7e knp-icon-only icon-heart">Like</button>
<input type="hidden" name="userID" id="userID" value="{{ $userID }}">
           <input type="hidden" id="soundID" name="soundID" value="{{ $soundID }}">
              </li>
              <li>

         @else

            <button id="favAdd" tooltip="Favorit" class="knp knp-7 knp-7e knp-icon-only icon-heart-2">Like</button>
<input type="hidden" name="userID" id="userID" value="{{ $userID }}">
           <input type="hidden" id="soundID" name="soundID" value="{{ $soundID }}">
         
         @endif
   
             
            </li>
            <li>
            <!-- formulär för att skapa spellista -->
            <!-- om man ej har listor -->
          
   <!-- stjärnknappen öppnar formuläret -->  
            <div class="btn-group">   
              <button type="button" tooltip="Lägg till i spellista" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="knp knp-7 knp-7f knp-icon-only icon-star">
              </button>
                <div class="dropdown-menu" id="podmenudropdown">
                  @if(is_null($listCheck))
                  <p style="margin-left: 10%; color: #26a09f; font-size: 13px; font-family: 'Museo';">Du har inga spellistor</p>
            <div class="podmenudropdown-btn2"> 
                  <a href="http://localhost/Herz/public/playlist"><button type="button" class="btn btn-primary">Skapa ny spellista</button></a>
                </div>
         @else
          <div>
          <!-- hidden fields -->


          </div>

          <p style="margin-left: 10%; color: #26a09f; font-size: 13px;">Välj lista:</p>
          <div class="podmenudropdown-list">  
              <label>
              <select name="listID">
              @foreach($lists as $list)
              <option value="{{$list->listID}}">{{ $list->listTitle }}</option>
              @endforeach
            </select>

    <button id="plAdd" class="btn btn-primary">Lägg till!</button>
      <input type="hidden" name="soundID" id="soundID" value="{{ $soundID }}">
            </label>
            </div>
              <div class="podmenudropdown-btn">  

    </div>

    <div class="podmenudropdown-btn2"> 
            <a href="http://localhost/Herz/public/playlist"><button type="button" class="btn btn-primary">Skapa ny spellista</button></a>
            </div>

            <script type="text/javascript">
              $('.dropdown-menu').click(function(e) {
    e.stopPropagation();
});
            </script>
 </div>
 </div>
</li>

@endif
<li>
 <button onclick="myFunction()" tooltip="Extern ljudspelare" class="knp knp-7 knp-7e knp-icon-only icon-bigger"></button>
 </li> 
      @endif



            <li id="podmenu-right">
             <!--  Anmälning knappen --> 
                 
              <div class="btn-group">
                <button type="button" tooltip="Anmäl klipp" class="knp knp-7 knp-7f knp-icon-only icon-alert" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu" id="podmenudropdown2">
                    <p style="margin-left: 10%; color: #26a09f; font-size: 13px; text-align: center;">Tycker du att poden är kränkade? Här kan du anmäla den.</p>
                  @if(Auth::check())
                    <form action="" method="post" id="report" name="report">
            {!! csrf_field() !!} 
              <input type="text" name="msg" id="msg" placeholder="Varför vill du anmäla klippet?">
              <input type="hidden" name="soundID" id="soundID" value="{{ $sound->soundID }}">
              <input type="hidden" name="username" id="username" value="{{ Auth::user()->username }}">
            <button type="submit" id="reportBtn" class="btn btn-primary">Anmäl</button>        
            </form> 
      
            </div>
        
            @else
            <input type="text" name="msg" id="msg" placeholder="Logga in för att anmäla">
            @endif
              </div>
               <!--  Anmälning knappen slut -->      
             </li>
             <li>
             <div id="FBSHARE" class="hidden"><form action=""><input type="hidden" name="fblink" id="fblink" value="https://www.facebook.com/Webbprojekt-Herz-275113066162500/{{ $sound->soundID }}"></form></div>
              <button type="button" onclick="share();" tooltip="Dela på Facebook" class="knp knp-7 knp-7f knp-icon-only fb-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              </li>
              <!--  Favorit mätare? den som visa hur måna favorit har poden -->         
             <li id="podmenu-right2">
             @if(is_null($favNr))

                <td><p><span class="glyphicon glyphicon-heart" style="color: #26a09f;  margin-top: 6px; margin-left: 18%;">:000</span></p></td>
             
             @else
             <div id="favNr">
<input type="hidden" id="favNrG" value="{{ $favNr }}">
                <td><p><span class="glyphicon glyphicon-heart" style="color: #26a09f; margin-top: 6px; margin-left: 18%;" id="favRem">{{$favNr}}</span></p></td></div>
                @endif
              </li>
              <!--  Favorit mätare slut -->            
            </ul>
            <!-- knappen för öppna i nytt fönster -->
           
            <!-- Knapp för att dela på Facebook -->
          </div>
   
           <!--  Podmenubar slut --> 
            <!--  Podinfo box --> 
          <div class="podinfo">
            <div class="podinfo-header">
              <h3>{{ $sound->title }}- av <a href="http://localhost/Herz/public/channel/{{ $channel->channelID }}">{{ $channel->channelname}}</a></h3>
            </div>
            <div class="podinfo-kat">
              <p>Kategori: {{ $category->categoryname }}</p>
            </div>
            <div class="info">
              <h4>Beskrivning:</h4>
            <div class="infobox">
              <p>{{ $sound->description }}</p>
            </div>
          </div>
          <div class="poddatum">
            <p>Uppladat: {{ $uploaded }}</p>
          </div>
          <div class="podtaggar">
              <h5>Taggar:</h5>
              <p>{{ $sound->tag }}</p>
          </div>
        </div>
         <!--  Podinfo box slut --> 
      </div>
         <!--  Första kolumnen slutar här -->
          <!--  Här börjar andra kolumnen -->  
      <div class="col-md-6" id="cmt-box">
      <!--  hela komment input boxen, med ram osv -->
     <!-- om användare inloggad kan kommentera -->  
  @if(Auth::user()) <div class="addcomment">
          <!--  input boxen -->
          <div class="addcomment-box">
<!-- feedback från formuläret nedan -->
   @if(Session::has('message'))
<div class="alert alert-danger">
  {{ Session::get('message') }}
</div>
@endif    

    {!! csrf_field() !!}
    <div id="commentFB"></div>
             @if(is_null($commentsCheck))
<input type="hidden" mame="null" id="null" value="null">
@else
<input type="hidden" mame="null" id="null" value="notnull">
@endif
        <input type="hidden" name="userID" value="{{ $userID }}"><!-- Dolt fält som hämtar Användarid -->
        <input type="hidden" name="soundID" value="{{ $sound->soundID }}"><!-- Dolt fält som hämtar ljudid -->
            <input type="text" class="form-control" placeholder="Lägg till komment" name="comment" id="comment"/>
          </div>
          <!--  komment knappen -->
          <div class="addcomment-btn">
            <button type="submit" id="commentBtn" class="btn btn-primary">Lägg till</button>
         
            
          </div>


        </div>
        @else
        <!-- om användaren inte är inloggad kan ej kommentera -->
        <div class="addcomment">
          <!--  input boxen -->
          <div class="addcomment-box">
 <input type="text" class="form-control" placeholder="Logga in för att kommentera" name="comment"/>
</div>
</div>
        @endif
      <!--  komment input boxen slut -->

      <!--  Kommentarer börjar här -->
        <div class="comment">
          <div class="panel panel-primary">
            <div class="panel-heading"><button type="button" id="commentRefresh" tooltip="Läs in kommentarer" class="knp"><span class="glyphicon glyphicon-refresh"></span></button>Kommentarer:  </div>          <!--  komment header -->
          <div class="panel-body"> <!--  boxen som innehåller kommentarer --> 
           <!--  1 st komment -->
                      <div id="commentbox2">
           @if(is_null($commentsCheck))
           <P>Denna pod har inga kommentarer</P>
           @else

           @foreach($comments as $comment)
           <!-- för att hämta ut rätt "created_at" då det finns i flertalet tabeller -->
           <?php
$commentUpload = DB::table('comments')->where('commentID', '=', $comment->commentID)->first();

           ?>
            <div class="commentbox">
                <ul>
                  <li class="well">
                    <ul>
                              <!--  Använder information-->

                      <li id="well-left" ><img src="{{ $comment->profilePicture }}" width="40px" height="40px" ></li>
                      <li id="well-left"><a href="http://localhost/Herz/public/user/{{ $comment->userID}}">{{ $comment->username }}</a></li>
                      <li id="well-left-right">{{ $commentUpload->created_at}}</li>
                    </ul>
                  </li> 
                  <!--  Komment -->
                  <div class="well2"><p>{{ $comment->comment}}</p>
                  </div>
                </ul>
              </div>
              @endforeach
              </div>
@endif
<div id="commentbox"></div>

                                                                     
            </div><!--  Panel-body slut-->
          </div><!--  div comment slut -->
      </div><!--  Andra Kolumnen slut -->
    </div><!--  col-md-12 slut -->
  </div><!--  container slut -->
</div><!--  div som vi behöver att footer hamnar rätt -->

    <script>


          function myFunction() {
window.open("http://localhost/Herz/public/mp3_player/mp3_player.swf", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=150");
}
             function share() {

              var link = $('#fblink').val();
              
        FB.ui({
            method: 'share',
            href: link,
        });
    }

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '702445809895140',
            xfbml      : true,
            version    : 'v2.3'
        });
    };

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=702445809895140";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
            </script>
             <script src="http://localhost/Herz/public/js/showsounds.js" charset="UTF-8"></script>
</body>
@stop