<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class user_fdiscusion
 * @package App\Models
 * @version June 4, 2020, 1:12 am UTC
 *
 * @property integer user_id
 * @property interger fdiscusion_id
 */
class user_fdiscusion extends Model
{
    use SoftDeletes;

    public $table = 'user_fdiscusions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'fdiscusion_id'
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

    public function fdiscusion() {
        return $this->belongsToMany('App\Models\fdiscusion','fdiscusion_id');
    }
    
}
