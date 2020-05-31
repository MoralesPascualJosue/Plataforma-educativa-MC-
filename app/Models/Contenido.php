<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contenido
 * @package App\Models
 * @version May 28, 2020, 5:16 pm UTC
 *
 * @property integer curso_id
 * @property integer activitie_id
 */
class Contenido extends Model
{
    use SoftDeletes;

    public $table = 'contenidos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'curso_id',
        'activitie_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'curso_id' => 'integer',
        'activitie_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'curso_id' => 'required',
        'activitie_id' => 'required'
    ];

     public function activitie() {
        return $this->belongsToMany('App\Models\Activitie','activitie_id');
    }

    public function curso() {
        return $this->belongsToMany('App\Models\curso','curso_id');
    }

    
}
