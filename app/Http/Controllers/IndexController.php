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
/* denna startsida om användare inloggad */
         return view('index', compact('users'));  

     }
     else{
        /* denna startsida om användare EJ inloggad */
        return view('home', compact('users'));  
     }
    }
}