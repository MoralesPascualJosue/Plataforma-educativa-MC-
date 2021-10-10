<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Task
 * @package App\Models
 * @version May 31, 2020, 12:09 am UTC
 *
 * @property string contenido
 * @property integer asesor_id
 */
class Task extends Model
{
    use SoftDeletes;

    public $table = 'tasks';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'contenido',
        'asesor_id',
        'activitie_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contenido' => 'array',
        'asesor_id' => 'integer',
        'activitie_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'contenido' => 'required'
    ];

    public function asesor(){
        return $this->belongsTo('App\Models\Asesor','asesor_id');
    }

    public function activitie(){
        return $this->belongsTo('App\Models\Activitie','activitie_id');
    }

    public function hasPropiedad($propietario){
        if ($this->asesor->id == $propietario) {
            return true;
        }
        return false;
    }
    
}
