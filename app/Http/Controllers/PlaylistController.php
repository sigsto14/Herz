<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Sound;
use App\Playlist;
use App\Favorite;
use Auth;
use Fetch;
use mysqli;
use App\Channel;
use Validator;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Symfony\Component\HttpFoundation\File;
use Eloquent;
use Storage;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('playlist.index');
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
   $validator = Validator::make($request->all(), [
                'listTitle' => 'required|max:255|',
            'listDescription' => 'required|',
            'userID' => 'required|',

            ]);
       if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();

          }

       $playlist = new Playlist();
       
       $playlist->listTitle = $request->get('listTitle');
       $playlist->listDescription = $request->get('listDescription');
       $playlist->userID = $request->get('userID');
       $playlist->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $user = User::find($id);
$playlist = Playlist::find($id);
return view('playlist.show', compact('user'), compact('playlists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       


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
        $listID = $request->get('listID');
     
$addSounds = Playlist::find($listID);

if(!is_null($addSounds)){
if(is_null($addSounds->soundIDs)){
   
$addSounds->soundIDs = $request->get('soundID');
}
else if (!is_null($addSounds->soundIDs)){
   
   $addSounds->soundIDs = $addSounds->soundIDs . ',' . $request->get('soundID'); 
}
}
$addSounds->save();

return back();


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

        public function exist($id)
    {
        /* funktion för att hämta ut användarens existerande spellistor */
       $id = Auth::user()->userID; 
DB::table('playlists')->where('userID', '=', $id)->get();



          }
}
