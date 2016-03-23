

       <?php
            /* först hämta ut userID och last_logout-value */
$userID = Auth::user()->userID;
$LastLogout = Auth::user()->last_logout;
/* om last logout inte finns (när man precis registrerat sig) ska vi inte söka efter det heller */
  if(is_null($LastLogout)){
    /* sätter variabel för hur många notiser man har */
        $LastLogout = Auth::user()->created_at;
       }
      
        /*hämtar ut notiserna och räknar antalet, sätter variabel av antalet */
              $notiNr = DB::table('subscribe')->join('channels', 'channels.channelID', '=', 'subscribe.channelID')->join('sounds', 'sounds.channelID', '=', 'channels.channelID')->where('subscribe.userID', '=', $userID)->where('sounds.created_at', '>', $LastLogout)
       ->orderBy('sounds.created_at', 'DESC')->count();
  
         if($notiNr < 1) {
          $notiNr = '';
         }
         echo $notiNr;
            
     ?>    
         

