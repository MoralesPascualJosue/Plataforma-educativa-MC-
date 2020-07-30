<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Anuncio
 * @package App\Models
 * @version May 21, 2020, 6:07 pm UTC
 *
 * @property string anuncio
 * @property integer user_id
 */
class Anuncio extends Model
{
    use SoftDeletes;

    public $table = 'anuncios';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'anuncio',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'anuncio' => 'string',
        'user_id' => 'integer',
        'updated_at' => 'date:Y-m-d'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'anuncio' => 'required'
    ];

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
    
}
