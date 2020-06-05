<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class fcategoria
 * @package App\Models
 * @version June 3, 2020, 11:41 pm UTC
 *
 * @property string name
 * @property string color
 */
class fcategoria extends Model
{
    use SoftDeletes;

    public $table = 'fcategorias';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'color'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'color' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function fdiscusiones(){
        return $this->hasMany('App\Models\fdiscusion');
    }
    
    
}
