<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use Illuminate\Notifications\Notifiable;
/**
 * Class Estudiante
 * @package App\Models
 * @version May 25, 2020, 7:42 pm UTC
 *
 * @property string name
 * @property string bio
 * @property string image
 * @property string institute
 * @property string department
 * @property interger telephone
 * @property interger user_id
 */
class Estudiante extends Model
{
    use SoftDeletes,Notifiable;

    public $table = 'estudiantes';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'bio',
        'image',
        'institute',
        'department',
        'telephone',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'bio' => 'string',
        'image' => 'string',
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
        'telephone' => 'numeric'
    ];

    public function cursos(){
        return $this->belongsToMany('App\Models\curso','matriculados','estudiante_id','curso_id')->withPivot('updated_at');
    }

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }     

    public function works(){
        return $this->hasMany('App\Models\Work');
    }    
    
    public function qualifications(){
        return $this->hasMany('App\Models\Qualification');
    }

   public function scopeWithUser( $query){
        $subquery = User::select('users.id') 
        ->whereColumn('users.id', 'estudiantes.user_id');
 
        $query->addSelect(['usuario_id' => $subquery]);
    }
}
