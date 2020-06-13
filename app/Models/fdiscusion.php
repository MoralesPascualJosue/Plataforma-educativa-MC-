<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

/**
 * Class fdiscusion
 * @package App\Models
 * @version June 3, 2020, 11:53 pm UTC
 *
 * @property string title
 * @property integer views
 * @property integer answered
 * @property integer user_id
 * @property integer curso_id
 * @property integer fcategoria
 */
class fdiscusion extends Model
{
    use SoftDeletes;

    public $table = 'fdiscusions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'body',
        'views',
        'answered',
        'user_id',
        'curso_id',
        'fcategoria'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'body' => 'string',
        'views' => 'integer',
        'answered' => 'integer',
        'user_id' => 'integer',
        'curso_id' => 'integer',
        'fcategoria' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];

    public function curso() {
        return $this->belongsTo('App\Models\Curso','curso_id');
    }

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

   public function fcategoria() {
        return $this->belongsTo('App\Models\fcategoria','fcategoria');
    }

    public function posts() {
        return $this->hasMany('App\Models\fpost');
    }

    public function users(){
        return $this->belongsToMany('App\User','user_fdiscusions', 'fdiscusion_id',"user_id");
    }   

    public function hasPropiedad($propietario){

        if ($this->user->id == $propietario) {
            return 1;
        }
        return 0;
    }

    public function scopeWithCategoria( $query){
         $subquery = fcategoria::select('fcategorias.name') 
         ->whereColumn('fcategorias.id', 'fdiscusions.fcategoria');//->first();
        //->latest() 
        //->limit(1); 
 
        $query->addSelect(['nameCategoria' => $subquery]);
 
     //   $query->with('fcategoria'); //todo el objeto
    }

    public function scopeWithCategoriaColor( $query){
         $subquery = fcategoria::select('fcategorias.color') 
         ->whereColumn('fcategorias.id', 'fdiscusions.fcategoria');// regresa un registro
 
        $query->addSelect(['colorCategoria' => $subquery]);
    }

    public function scopeWithUser( $query){
         $subquery = User::select('users.name') 
         ->whereColumn('users.id', 'fdiscusions.user_id');
 
        $query->addSelect(['usuarioName' => $subquery]);
    }

     public function scopeWithCurso($query,$curso)
    {
        return $query->where('curso_id','=', $curso);
    }

    public function scopeWithPropietario( $query){
         $subquery = User::select('users.id') 
         ->whereColumn('users.id', 'fdiscusions.user_id');
 
        $query->addSelect(['propietario' => $subquery]);
    }
}
