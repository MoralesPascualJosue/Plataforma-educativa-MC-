<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    //

    public $table = 'messages';

    public $fillable = [
        'curso_id',
        'send',
        'reader',
        'asunto',
        'body'
    ];

    protected $cast = [
        'id' => 'integer',
        'curso_id' => 'integer',
        'send' => 'integer',
        'reader' => 'integer',
        'body' => 'string',
        'created_at' => 'date:Y-m-d'
    ];

    public function user() {
        return $this->belongsTo('App\User','send');
    }

    public function users(){
        return $this->belongsToMany('App\User','user_message','message_id','user_id');
    }

    public function curso() {
        return $this->belongsTo('App\Models\Curso','curso_id');
    }

    public function scopeWithUser( $query){
        $query->with('user'); //todo el objeto
    }    

    public function scopeWithImage( $query){
        $subquery = Estudiante::select('estudiantes.image')
        ->whereColumn('estudiantes.user_id', 'messages.send');

        $query->addSelect(['usuarioImage' => $subquery]);
    }

     public function hasPropiedad($propietario){

        if ($this->user->id == $propietario) {
            return true;
        }
        return false;
    }
}
