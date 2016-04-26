<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Channel;
use \App\User;
use Auth;
use DB;
use str;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

  
        $users = User::all();
if(Auth::check()){

         return view('index', compact('users'));  

     }
     else{
        return view('home', compact('users'));  
     }
    }
}