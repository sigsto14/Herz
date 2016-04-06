<?php
/** denna kontrollerar klassen Comment med tabellen comments och hur den får redigeras */
namespace App;



use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

 public function sounds()
    {
       return $this->belongsTo('sounds');
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comment', 'userID', 'soundID'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
