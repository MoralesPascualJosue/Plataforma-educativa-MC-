<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Qualification
 * @package App\Models
 * @version June 1, 2020, 6:17 am UTC
 *
 * @property integer qualification
 * @property string observaciones
 * @property integer estado
 * @property integer activitie_id
 */
class Qualification extends Model
{
    use SoftDeletes;

    public $table = 'qualifications';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'qualification',
        'observaciones',
        'estado',
        'curso_id',
        'activitie_id',
        'estudiante_id',        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'qualification' => 'integer',
        'observaciones' => 'string',
        'estado' => 'integer',
        'curso_id' => 'integer',
        'activitie_id' => 'integer',
        'estudiante_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'qualification' => 'required',
        'estado' => 'required'
    ];

    public function curso() {
        return $this->belongsTo('App\Models\Curso','curso_id');
    }

    public function activitie(){
        return $this->belongsTo('App\Models\Activitie','activitie_id');
    }

    public function estudiante() {
        return $this->belongsTo('App\Models\Estudiante','estudiante_id');
    }


}
