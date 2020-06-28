<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    //

    public $table = 'messages';

    public $fillable = [
        'chat',
        'send',
        'reader',
        'body'
    ];

    protected $cast = [
        'id' => 'integer',
        'chat' => 'integer',
        'send' => 'integer',
        'reader' => 'integer',
        'body' => 'string'
    ];

    public function user() {
        return $this->belongsTo('App\User','send');
    }

    public function chat() {
        return $this->belongsTo('App\Models\Chat','chat');
    }

    public function scopeWithUser( $query){
        $subquery = User::select('users.name')
        ->whereColumn('users.id', 'messages.send');

        $query->addSelect(['usuarioName' => $subquery]);
    }

    public function scopeWithImage( $query){
        $subquery = Estudiante::select('estudiantes.image')
        ->whereColumn('estudiantes.user_id', 'messages.send');

        $query->addSelect(['usuarioImage' => $subquery]);
    }
}
