<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

/**
 * Class Asesor
 * @package App\Models
 * @version April 4, 2020, 9:40 pm UTC
 *
 * @property string name
 * @property string image
 * @property string bio
 */
class Asesor extends Model
{
    use SoftDeletes;

    public $table = 'asesors';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'name',
        'bio',
        'institute',
        'department',
        'telephone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'bio' => 'string',
        'institute' => 'string',
        'department' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'bio' => 'required'
    ];

     public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function cursos(){
        return $this->hasMany('App\Models\Curso');
    }    

    public function activities(){
        return $this->hasMany('App\Models\Activitie');
    }

    public function tasks(){
        return $this->hasMany('App\Models\Task');
    }

    public function scopeWithUser( $query){
       $query->with('user');
    }
    
}
