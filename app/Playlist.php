<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Playlist extends Model
{

    
     protected $table = 'playlists';
    /* genom att sätta soundID som primary key här blir det det som blir ID i laravels $id-funktioner */
    
    protected $primaryKey = 'listID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['listTitle', 'listDescription', 'soundIDs'];

}
