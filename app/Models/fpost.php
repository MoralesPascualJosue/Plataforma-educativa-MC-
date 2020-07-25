<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

/**
 * Class fpost
 * @package App\Models
 * @version June 4, 2020, 12:22 am UTC
 *
 * @property string body
 * @property integer locked
 * @property integer fdiscusion_id
 * @property integer user_id
 */
class fpost extends Model
{
    use SoftDeletes;

    public $table = 'fposts';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'body',
        'locked',
        'fdiscusion_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'body' => 'string',
        'locked' => 'integer',
        'fdiscusion_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'body' => 'required'
    ];


    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function discusion() {
        return $this->belongsTo('App\Models\fdiscusion','fdiscusion_id');
    }

     public function scopeWithDiscuss($query,$discuss)
    {
        return $query->where('fdiscusion_id','=', $discuss);
    }

    public function scopeWithUser( $query){
         $subquery = User::select('users.name') 
         ->whereColumn('users.id', 'fposts.user_id');
 
        $query->addSelect(['usuarioName' => $subquery]);
    }

    public function scopeWithImage( $query){
         $subquery = User::select('users.image') 
         ->whereColumn('fposts.user_id','users.id');
 
        $query->addSelect(['image' => $subquery]);
    }

    public function hasPropiedad($propietario){

        if ($this->user->id == $propietario) {
            return 1;
        }
        return 0;
    }
    
}
