<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use App\User;
class ResetpasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function reset(Request $request)
{
    /* tar fram slumpat lösenord */
    $str = str_random(12);
    /*definierar användarens e-mail*/
    $email = $request->email;
    /* kollar om användaren finns */
   $user = User::where('email', '=', $email)->first();
if(!is_null($user)){
    /* om användaren finns ändrar dess lösenord */
    $user->password = bcrypt($str);
$user->save();

/* skickar med dessa variabler till en "osynlig" view med ett formulär som skickar dessa variabler automatiskt */
return view('send', compact('str'), compact('user'));

}
else if(is_null($user)){
    return back()->withMessage('Email ej registrerad');
}


}

    public function index()
    {

        return view('reset.resetPassword');
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
