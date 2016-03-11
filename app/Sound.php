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

class Sound extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract



{
    use Authenticatable, Authorizable, CanResetPassword;

 public function sounds()
    {
      
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sounds';
    /* genom att sätta soundID som primary key här blir det det som blir ID i laravels $id-funktioner */
    
    protected $primaryKey = 'soundID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'URL', 'tag', 'status', 'channelID'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
