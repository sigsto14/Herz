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
    /* kommentarerna på klippet */      $comments = DB::table('comments')->join('users', 'users.userID', '=', 'comments.userID')->where('soundID', '=', $sound->soundID)->get();
     /* för att kolla om nulll */      $commentsCheck = DB::table('comments')->join('users', 'users.userID', '=', 'comments.userID')->where('soundID', '=', $sound->soundID)->first();
      /*för att hämta kategorinamn */    $category = DB::table('category')->where('categoryID', '=', $sound->categoryID)->first();
      /* hämtar ut tiden klippet laddades upp */  $uploaded= substr($category->created_at, 0, 10);
       /* hur många som har klippet som favorit*/       $favNr = DB::table('favorites')->where('soundID', '=', $sound->soundID)->count();
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
       
        <!-- php-kod för att kolla om det redan är favorit. Det fungerar ej med eloquent så vanlig sql/php löser problemet -->
        @if(Auth::check())
        <?php
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

        ?>
         @if($state == 0)
         {!! Form::open(array('route' => 'favorite.store')) !!}
        {!! csrf_field() !!}
         <input type="hidden" name="userID" value="{{ Auth::user()->userID }}">
           <input type="hidden" name="soundID" value="{{ $sound->soundID }}">
            <button tooltip="Lägg till favorit" class="knp knp-7 knp-7e knp-icon-only icon-heart">Like</button>

              </li>
              <li>
              {!! Form::close() !!}
         @else
{!! Form::open(array('method' => 'DELETE', 'route' => array('favorite.destroy', $sound->soundID)))  !!}
            <button tooltip="Ta bort favorit" class="knp knp-7 knp-7e knp-icon-only icon-heart-2">Like</button>

              {!! Form::close() !!}
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
         <p style="margin-left: 10%; color: #26a09f; font-size: 13px;>Du har inga spellistor</p><button type="button"><a href="http://localhost/Herz/public/playlist"> Skapa ny spellista</a></button>
         @else
 {!! Form::open(array('route' => 'playlist.update', 'method' => 'PUT')) !!}
          <div>
          <!-- hidden fields -->

            <input type="hidden" name="soundID" value="{{ $sound->soundID }}">
          </div>
          <p style="margin-left: 10%; color: #26a09f; font-size: 13px;">Välj lista:</p>
          <div class="podmenudropdown-list">  
              <label>
              <select name="listID">
              @foreach($lists as $list)
              <option value="{{$list->listID}}">{{ $list->listTitle }}</option>
              @endforeach
            </select>
            </label>
            </div>
            <div class="podmenudropdown-btn">  

    <button type="submit" class="btn btn-primary">Lägg till!</button>
    </div>

    <div class="podmenudropdown-btn2"> 
            <button type="button" class="btn btn-primary"><a href="http://localhost/Herz/public/playlist"></a>Skapa ny spellista</button>
            </div>
 </div>
 </li> 
@endif
      @endif



            <li id="podmenu-right">
             <!--  Anmälning knappen --> 
              <div class="btn-group">
                <button type="button" tooltip="Anmäl klipp" class="knp knp-7 knp-7f knp-icon-only icon-alert" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu" id="podmenudropdown2">
                    <p style="margin-left: 10%; color: #26a09f; font-size: 13px; text-align: center;">Tycker du att poden är kränkade? Här kan du anmäla den.</p>
                  @if(Auth::check())
                    <form action="http://ideweb2.hh.se/~sigsto14/Test/report.php" method="post" id="report">
            {!! csrf_field() !!} 
              <input type="text" name="msg" id="msg" placeholder="Varför vill du anmäla klippet?">
              <input type="hidden" name="soundID" id="soundID" value="{{ $sound->soundID }}">
              <input type="hidden" name="user" id="user" value="{{ Auth::user()->username }}">
              <button type="submit"  class="btn btn-primary">Anmäl</button>
            </form> 
            @else
            <input type="text" name="msg" id="msg" placeholder="Logga in för att anmäla">
            @endif
                </div>
              </div>
               <!--  Anmälning knappen slut -->      
             </li>
              <!--  Favorit mätare? den som visa hur måna favorit har poden -->         
             <li id="podmenu-right2">
             @if(is_null($favNr))

                <td><p><span class="glyphicon glyphicon-heart" style="color: #26a09f;  margin-top: 6px; margin-left: 18%;">:000</span></p></td>
             
             @else

                <td><p><span class="glyphicon glyphicon-heart" style="color: #26a09f; margin-top: 6px; margin-left: 18%;">{{$favNr}}</span></p></td>
                @endif
              </li>
              <!--  Favorit mätare slut -->            
            </ul>
          </div>
           <!--  Podmenubar slut --> 
            <!--  Podinfo box --> 
          <div class="podinfo">
            <div class="podinfo-header">
              <h3>{{ $sound->title }}- av {{ $channel->channelname}}</h3>
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
    {!! Form::open(array('route' => 'comment.store', 'files' => 'true')) !!}
    {!! csrf_field() !!}
        <input type="hidden" name="userID" value="{{ Auth::user()->userID }}"><!-- Dolt fält som hämtar Användarid -->
        <input type="hidden" name="soundID" value="{{ $sound->soundID }}"><!-- Dolt fält som hämtar ljudid -->
            <input type="text" class="form-control" placeholder="Lägg till komment" name="comment"/>
          </div>
          <!--  komment knappen -->
          <div class="addcomment-btn">
            <button type="submit" class="btn btn-primary">Lägg till</button>
         
            
          </div>
          {!! Form::close() !!}

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
            <div class="panel-heading">Kommentarer:</div>          <!--  komment header -->
          <div class="panel-body"> <!--  boxen som innehåller kommentarer --> 
           <!--  1 st komment -->
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
                      <li id="well-left" ><img src="http://localhost/Herz/public/images/Profilepictures/none.png"></li>
                      <li id="well-left">{{ $comment->username }}</li>
                      <li id="well-left-right">{{ $commentUpload->created_at}}</li>
                    </ul>
                  </li> 
                  <!--  Komment -->
                  <div class="well2"><p>{{ $comment->comment}}</p>
                  </div>
                </ul>
              </div>
              @endforeach
@endif

                                                                     
            </div><!--  Panel-body slut-->
          </div><!--  div comment slut -->
      </div><!--  Andra Kolumnen slut -->
    </div><!--  col-md-12 slut -->
  </div><!--  container slut -->
</div><!--  div som vi behöver att footer hamnar rätt -->
</body>
@stop