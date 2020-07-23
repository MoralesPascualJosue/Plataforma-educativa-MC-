<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class user_fdiscusion
 * @package App\Models
 * @version June 4, 2020, 1:12 am UTC
 *
 * @property integer user_id
 * @property interger chat:id
 */
class user_message extends Model
{

    public $table = 'user_message';



    public $fillable = [
        'user_id',
        'message_id',
        'news'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

     public function user() {
        return $this->belongsToMany('App\User','user_id');
    }

    public function chat() {
        return $this->belongsToMany('App\Models\Message','message_id');
    }
    
}
