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
class user_chat extends Model
{

    public $table = 'user_chat';



    public $fillable = [
        'user_id',
        'chat_id',
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
        return $this->belongsToMany('App\Models\Chat','chat_id');
    }
    
}
