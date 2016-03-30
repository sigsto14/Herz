<?php
/** denna kontrollerar klassen Channel med tabellen channelss och hur den får redigeras */
namespace App;



use Illuminate\Database\Eloquent\Model;

class Channel extends Model {

 public function users()
    {
       return $this->belongsTo('User');
       return $this->hasMany('Sound');
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'channels';
    /* genom att sätta primaryKey här till channelID som är primärnyckeln i tabellen blir det denna som söks i $id-requests */
    protected $primaryKey = 'channelID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['channelID', 'channelname', 'userID',  'information','profilepicture'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
