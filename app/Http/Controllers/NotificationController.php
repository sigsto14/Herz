<?php

namespace App\Http\Controllers;



use App\User;
use App\Sound;
use App\Favorite;
use App\Subscribe;
use Auth;
use Fetch;
use App\Channel;
use Validator;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Symfony\Component\HttpFoundation\File;
use Eloquent;
use Storage;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return auto
     */
    public function index()
    {
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
       ->orderBy('sounds.created_at', 'DESC')->take(5)->count();
   
            
}
else {
}
return view('notification.index', compact('subscribe'), compact('user'), compact('channel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
