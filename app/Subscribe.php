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

class Subscribe extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract



{
    use Authenticatable, Authorizable, CanResetPassword;

 public function subscribe()
    {
     return $this->hasMany('Channel');
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscribe';
    /* genom att sätta userID som primary blir det lättare att hämta ut just den användarens favoriter. AVVAKTAR CONSTRAINTS  */
    
    protected $primaryKey = 'channelID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['userID', 'channelID'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
