<?php
/** denna kontrollerar klassen User med tabellen users och hur den får redigeras */
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract



{
    use Authenticatable, Authorizable, CanResetPassword;

 public function users()
    {
      
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    /* genom att sätta userID som primaryKey blir det detta ID som söks upp i $id-requests */
    protected $primaryKey = 'userID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'profilePicture', 'last_login', 'last_login_ip'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];
}
