<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Work
 * @package App\Models
 * @version May 31, 2020, 8:25 pm UTC
 *
 * @property string contenido
 * @property integer entregas
 * @property integer activitie_id
 * @property integer estudiante_id
 */
class Work extends Model
{
    use SoftDeletes;

    public $table = 'works';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'contenido',
        'entregas',
        'activitie_id',
        'estudiante_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contenido' => 'string',
        'entregas' => 'integer',
        'activitie_id' => 'integer',
        'estudiante_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'contenido' => 'required'
    ];

    public function estudiante(){
        return $this->belongsTo('App\Models\Estudiante','estudiante_id');
    }

    public function activitie(){
        return $this->belongsTo('App\Models\Activitie','activitie_id');
    }
    
}
