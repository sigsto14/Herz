<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\User;
use App\Channel;
use App\Userinfo;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DateTime;


class AuthController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

protected $loginPath = '';

 protected $redirectPath = 'back';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:50|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|confirmed|min:6',
                    ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
$dateTime = new DateTime;
     return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profilePicture' => $data['profilePicture'],
          ]);                

       return back();

}

/* kod för att directa användare till att fylla i kanalinfo när den registrerat, men ej vid inloggning */
public function postRegister(Request $request)
{


    $validator = $this->validator($request->all());

    if ($validator->fails()) {
        $this->throwValidationException(
            $request, $validator
        );
      
    }

  
  Auth::login($this->create($request->all()));

   return redirect()->intended();
}

}
    

