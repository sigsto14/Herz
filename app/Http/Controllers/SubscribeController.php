<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use App\Sound;
use App\Favorite;
use App\Subscribe;
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

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* sammanbindningar så det går att hämta ut massa massa data från databasen med dessa variabler **/
        if(Auth::check()){
        $userID = Auth::user()->userID; }
       $subs = DB::table('subscribe')->join('users', 'subscribe.userID', '=', 'users.userID')->join('channels', 'shannels.channelID', '=', 'subscribe.channelID')->get();

       return view('subscribe.index', compact('subscribe'), compact('channel'), compact('sound'), compact('user'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
/*hämta data från hidden form fieldet */


$subscribe = new Subscribe();
         $subscribe->userID = $request->get('userID');
       $subscribe->channelID = $request->get('channelID');
       $subscribe->save();
       return back();
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
       }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $subscribe = Subscribe::where('channelID', '=', $id);
       $subscribe->delete();
        return back();
    }
}
