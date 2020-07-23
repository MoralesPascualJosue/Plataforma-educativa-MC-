<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'image' => 'string'
    ];

     public function asesor() {
        return $this->hasOne('App\Models\Asesor','user_id');
    }

    public function estudiante() {
        return $this->hasOne('App\Models\Estudiante','user_id');
    }

     public function anuncios(){
        return $this->hasMany('App\Models\Anuncio');
    }

     public function posts(){
        return $this->hasMany('App\Models\fpost');
    }

     public function fdiscusions(){
        return $this->hasMany('App\Models\fdiscusion');
    }

    public function fdiscusiones(){
        return $this->belongsToMany('App\Models\fdiscusion', 'user_fdiscusions', 'user_id', 'fdiscusion_id');
    }

    public function mensages(){
        return $this->belongsToMany('App\Models\Message', 'user_message', 'user_id', 'message_id')->withPivot('news');
    }

    public function messages(){
        return $this->hasMany('App\Models\Message','send');
    }   

}
