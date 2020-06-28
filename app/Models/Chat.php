<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    public $table = 'chats';

    public $fillable = [
        'name',
        'curso_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'curso_id' => 'integer'
    ];

    public static $rules = [
        'name' => 'required'
    ];

    public function users(){
        return $this->belongsToMany('App\User','user_chat','chat_id','user_id');
    }

    public function messages(){
        return $this->hasMany('App\Models\Message','chat');
    }

    public function curso() {
        return $this->belongsTo('App\Models\curso','curso_id');
    }

    public function participante($u){
        $user = $this->users()->where('user_id',$u)->get();

        if(empty($user[0])){
            return 0;
        }

        return 1;
    }

}
