<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Activitie
 * @package App\Models
 * @version May 27, 2020, 8:47 pm UTC
 *
 * @property string title
 * @property integer visible
 * @property integer intentos
 * @property string fecha_inicio
 * @property string fecha_final
 */
class Activitie extends Model
{
    use SoftDeletes;

    public $table = 'activities';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'visible',
        'intentos',
        'fecha_inicio',
        'fecha_final',
        'asesor_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'visible' => 'integer',
        'intentos' => 'integer',
        'asesor_id' => 'integer',
        'created_at' => 'date:Y-m-d'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'visible' => 'required',
        'intentos' => 'required',
        'fecha_inicio' => 'required',
        'fecha_final' => 'required'        
    ];

    public function asesor(){
        return $this->belongsTo('App\Models\Asesor','asesor_id');
    }

    public function cursos(){
        return $this->belongsToMany('App\Models\Curso','contenidos','activitie_id','curso_id');
    }

     public function task() {
        return $this->hasOne('App\Models\Task','activitie_id');
    }

    public function works(){
        return $this->hasMany('App\Models\Work');
    }    

     public function qualifications() {
        return $this->hasMany('App\Models\Qualification');
    }

    public function hasPropiedad($propietario){
        if ($this->asesor->id == $propietario) {
            return true;
        }
        return false;
    }
}
