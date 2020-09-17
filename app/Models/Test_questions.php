<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test_questions extends Model
{
    use SoftDeletes;

    public $table = 'test_questions';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'question',
        'type',
        'feedback',
        'curso_id',
        'test_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'question' => 'string',
        'type' => 'string',
        'feedback' => 'string',
        'curso_id' => 'integer',
        'test_id' => 'integer'
    ];

    public function curso(){
        return $this->belongsTo('App\Models\Curso','curso_id');
    }

    public function test(){
        return $this->belongsTo('App\Models\Test','test_id');
    }

    // public function tests(){
    //     return $this->belongsToMany('App\Models\Test','test_content','question_id','test_id')->withPivot('updated_at');
    // }

    public function questionOptions(){
        return $this->hasMany('App\Models\Test_question_options');
    }

    public function questionAnswered(){
        return $this->hasMany('App\Models\Test_question_answered');
    }
}
