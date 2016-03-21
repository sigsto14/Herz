<?php

namespace App\Http\Controllers;


use App\User;
use App\Sound;
use App\Favorite;
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


class SoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $users = DB::table('users')->orderBy('username')->get();
        $channel = DB::table('channels')->join('users', 'users.userID', '=', 'channels.channelID')->get();
        //Koden ovan binder samman users och channel så vi kan använda de i samma tabeller.
        $sounds = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->get();
        //Koden ovan binder samman channels och sounds så vi kan använda de i samma tabeller.
     
        return view('sounds.index', compact('users'), compact('channel'), compact('sound'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sounds.create');
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
                'title' => 'required|unique:sounds|max:255',
            'image'=>'required|image|mimes:jpg,jpeg,png,bmp',
            'categoryID' => 'required|',
         
            ]);

          if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();

          }

    if($request->hasFile('audio')) {
      /* sätter namn och får fram om det är ex jpg eller wav-filer så vi kan länka till ljud/bild */      
            $soundName = $request->title . '.' .
            $request->file('audio')->getClientOriginalExtension();
/*lägger filen där vi ska spara den*/
            $request->file('audio')->move(
            base_path() . '/public/sounds', $soundName
            );
/* samma med bild som ljud*/
            $imageName = $request->title . '.' .
            $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(
            base_path() . '/public/Podcastpictures', $imageName
            );
/*skapar ny rad i tabellen med hjälp av modellen Sound */
$sound = new Sound();
         $sound->title = $request->get('title');
         $sound->categoryID = $request->get('categoryID');
         $sound->URL = "http://localhost/Herz/public/sounds/$soundName";
         $sound->podpicture = "http://localhost/Herz/public/Podcastpictures/$imageName";
         $sound->tag = $request->get('tag');
         $sound->channelID= Auth::user()->userID;
        $sound->save();
        return back()
        ->withMessage('Din podcast är uppladdad!');


    }

    
    else {
        /* felmeddelande om man inte har valt nåt ljudklipp att ladda upp */
      return back()
                        ->withMessage('Du måste välja en fil att ladda upp!');
}

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
  
$sound = Sound::find($id);
return view('sounds.show', compact('channel'), compact('sound'));
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
        $favorite = Favorite::where('soundID', '=', $id);
          $sound = Sound::where('soundID', '=', $id);
          $favorite->delete();
       $sound->delete();
        return back()->withMessage('Ljudklipp raderat!');
    }
}
