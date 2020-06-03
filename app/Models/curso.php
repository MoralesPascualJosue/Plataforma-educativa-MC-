<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class curso
 * @package App\Models
 * @version April 9, 2020, 4:16 pm UTC
 *
 * @property string title
 * @property string review
 * @property string cover
 * @property integer asesor_id
 */
class curso extends Model
{
    use SoftDeletes;

    public $table = 'cursos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'review',
        'cover',
        'asesor_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'review' => 'string',
        'cover' => 'string',
        'asesor_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'review' => 'required'
    ];

    public function asesor(){
        return $this->belongsTo('App\Models\Asesor','asesor_id');
    }

    public function estudiantes(){
        return $this->belongsToMany('App\Models\Estudiante','matriculados','curso_id','estudiante_id');
    }

    public function activities(){
        return $this->belongsToMany('App\Models\Activitie','contenidos','curso_id','activitie_id')->withPivot('updated_at');
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
/* */
    public function hasMatriculado($matriculado)
    {
        if ($this->estudiantes()->where('estudiante_id', $matriculado)->first()) {
            return true;
        }
        return false;
    }

    public function authorizeMatriculado($matriculas)
    {
        if ($this->hasAnyMatriculado($matriculas)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }
    
    public function hasAnyMatriculado($matriculas)
    {
        if (is_array($matriculas)) {
            foreach ($matriculas as $matricula) {
                if ($this->hasMatriculado($matricula)) {
                    return true;
                }
            }
        } else {
            if ($this->hasMatriculado($matriculas)) {
                return true;
            }
        }
        return false;
    }
    
    public function acceso($plain_text){
        if ($plain_text == $this->password) {
            // The passwords match...
            return true;
        }

        return false;
    }

}
