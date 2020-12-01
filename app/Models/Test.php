<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use SoftDeletes;

    public $table = 'tests';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'instructions',
        'fecha_inicio',
        'fecha_final',
        'visible',
        'type',
        'result_release',
        'num_takes',
        'curso_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'instructions' => 'string',
        'visible' => 'integer',
        'type' => 'string',
        'result_release' => 'integer',
        'num_takes' => 'integer',
        'curso_id' => 'integer',
        'created_at' => 'date:Y-m-d'
    ];

    public function curso(){
        return $this->belongsTo('App\Models\Curso','curso_id');
    }

    // public function questions(){
    //     return $this->belongsToMany('App\Models\Test_questions','test_content','test_id','question_id');
    // }

    public function questions(){
        return $this->hasMany('App\Models\Test_questions');
    }

    public function results(){
        return $this->hasMany('App\Models\Test_result');
    }
}
