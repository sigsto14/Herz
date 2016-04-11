<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use App\Sound;
use Auth;
use Fetch;
use App\Picture;
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
class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
/* definerar variabler, inaktiv funktion för tillfället */


        $channels = DB::table('channels')->join('users', 'users.userID', '=', 'channels.channelID')->get();
        //Koden ovan binder samman users och channel så vi kan använda de i samma tabeller.
        $sound = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->get();
        //Koden ovan binder samman channels och sounds så vi kan använda de i samma tabeller.
     
        return view('channels.index', compact('channel'), compact('sound'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('channels.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

  $channel = new Channel();
         $channel->information = $request->get('information');
         $channel->channelname = $request->get('channelname');
         $channel->channelID= Auth::user()->userID;
         $channel->userID= Auth::user()->userID;
        $channel->save();
        return view('index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
/* fixar så man hittar channel, denna funktion är för tillfället inaktiv ändå*/
   $user = User::find($id);
 $channel = Channel::find($id);
$sound = Sound::find($id);
return view('channels.show', compact('user'), compact('channel'), compact('sound'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
/* la till compact channel här också för säkerhets skull*/
           $channel = Channel::find($id);
       return view('channels.edit', compact('user'), compact('channel'));
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
        $userID = Auth::user()->userID;
        /*validerar så man inte kan fylla i tomt */
         $validator = Validator::make($request->all(), [
                'information' => 'required|max:255', 
            ]);


          if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();

          }

$channel = Channel::find($id);
/* variabel för inputen, för namnet på id't, och en för att kolla om värdet redan finns i databasen */
$channelname3 = $request->channelname;
$channelname = $channel->channelname;
$channelname2 = Channel::where('channelname', '=', $channelname3)->where('channelID', '!=', $userID)->first();
/* kollar om inputen är samma som nuvarande kanalnamn och uppdaterar därefter */
if($channelname3 == $channelname){

    $channel->information;
$channel->fill($request->all());
$channel->save();

    return back()->withMessage('Ditt konto har uppdaterats');
 
}

/* kollar så att det "nya" kanalnamnet från inputen inte finns i databasen än med hjäl av variabel channel2  och uppdaterar därefter */
else if (is_null($channelname2))
    {
$channel = Channel::find($id);
$channel->fill($request->all());
$channel->save();
 return back()->withMessage('Ditt konto har uppdaterats');
    
}

  /*annars är kanalnamnet uppdaget serru */
else {
    return back()->withMessage1('Kanalnamnet upptaget!');
}
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
              $user = User::find($id);
       $user->delete();
        return back();
         
    }
    
}
