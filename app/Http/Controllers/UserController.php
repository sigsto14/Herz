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
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

/* hämtar ut alla users så man kan se alla users*/

        $users = DB::table('users')->orderBy('username')->get();
        $channels = DB::table('channels')->join('users', 'users.userID', '=', 'channels.channelID')->get();
        //Koden ovan binder samman users och channel så vi kan använda de i samma tabeller.
        $sound = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->get();
        $subscribe = DB::table('subscrube')->join('users', 'users.userID', '=', 'subscribe.userID')->get();
        //Koden ovan binder samman channels och sounds så vi kan använda de i samma tabeller.
     
        return view('users.index', compact('users'), compact('channel'), compact('sound'), compact('subscribe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(array $data)
    {
/*users behöver ingen create här eftersom den görs i authcontrollern */

                    }
            


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* här skapas en ny rad i channels tabellen, med hjälp av modellen Channel */
/* (flyttat till ChannelController) */

}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      /* här hämtas id på modellerna ut så att vi kan visa data från både users och channels-tabellerna på samma sida */

       $user = User::find($id);
 $channel = Channel::find($id);
$sound = Sound::find($id);
return view('users.show', compact('user'), compact('channel'), compact('sound'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
/* definierar variabler för både users och channels tabellerna så vi kan redigera båda på samma sida*/
           $user = User::find($id);
       
  
           
      return view('users.edit', compact('user'));
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
        /* här uppdateras users vid det identifierade ID't */
 if($request->hasFile('image')) {
            $imageName = Auth::user()->username . '.' .
            $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(
            base_path() . '/public/images/Profilepictures', $imageName
            );

 $user = User::find($id);
 $user->profilePicture = "http://localhost/Herz/public/images/Profilepictures/$imageName";
        $user->fill($request->all());
        $user->save();
        return back()->withMessage('Ditt konto har uppdaterats');


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
            
            $subscribe = Subscribe::where('userID', '=', $id);
            
            $subscribers = Subscribe::where('channelID', '=', $id);
         
            $sounds = Sound::where('channelID', '=', $id)->get();
          
            foreach($sounds as $sound){
                $favorite = DB::table('favorites')->where('soundID', '=', $sound->soundID);
              
$favorite->delete();
 }

if(is_null($sounds))
{

    $channel = Channel::find($id);
    $channel->delete();
}
else {

    $sound = Sound::where('channelID', '=', $id);
    $sound->delete();
    $channel = Channel::find($id);
    if(!is_null($channel)){
        $subscribers = Subscribe::where('channelID', '=', $id);
        if(!is_null($subscribers)){
            $subscribers->delete();
        }
    $channel->delete();


}
}



 
              $user = User::find($id);                
                    $subscribe->delete();
                    $subscribers->delete();
 $user->delete();

 return view('index');
}

        
         
    
    
}

