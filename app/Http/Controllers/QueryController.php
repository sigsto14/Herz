<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use App\Sound;
use App\Category;
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

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $query = $request->get('Search');
   
  

    return view('search.index', compact('channels', $results), compact('sounds'), compact('users'));
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

public function search(Request $request)
{
    // variabler av inputen för att kunna testa
    $query = $request->get('search');
    //för att kolla kategorier
$categoryID = $request->get('categoryID');


// söker kanaler som matchar sökningen
    $channels = DB::table('channels')
    ->where('channels.channelname', 'LIKE', '%' . $query . '%')->take(5)->get();
//söker ljudklipp som matchar sökningen
 $sounds = DB::table('sounds')->join('channels', 'sounds.channelID', '=', 'channels.channelID')->join('category', 'category.categoryID', '=', 'sounds.categoryID')->where('sounds.title', 'LIKE', '%' . $query . '%')
   ->orwhere('sounds.categoryID', '=', $categoryID)->orwhere('sounds.tag', 'LIKE', '%' . $query . '%')->paginate(10);
// söker användare som matchar sökningen
$users = DB::table('users')->where('username', 'LIKE', '%' . $query . '%')->take(5)->get();

    return view('search.index', compact('sounds', 'query'), compact('channels', 'query'), compact('category', 'query'), compact('users', 'query'));
 }

}
