<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Matriculado
 * @package App\Models
 * @version May 26, 2020, 3:55 pm UTC
 *
 * @property interger estudiante_id
 * @property interger curso_id
 */
class Matriculado extends Model
{
    use SoftDeletes;

    public $table = 'matriculados';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'estudiante_id',
        'curso_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function estudiante() {
        return $this->belongsToMany('App\Models\Estudiante','estudiante_id');
    }

    public function curso() {
        return $this->belongsToMany('App\Models\curso','curso_id');
    }

}
