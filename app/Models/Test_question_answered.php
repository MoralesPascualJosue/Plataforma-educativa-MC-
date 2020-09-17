<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test_question_answered extends Model
{
      use SoftDeletes;

    public $table = 'test_question_answered';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'answer',
        'qualification',
        'notes',
        'question_id',
        'estudiante_id',
        'test_result_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'answer' => 'string',
        'qualification' => 'integer',
        'notes' => 'string',
        'question_id' => 'integer',
        'estudiante_id' => 'integer',
        'test_result_id' => 'integer'
    ];

    public function question(){
        return $this->belongsTo('App\Models\Test_questions','question_id');
    }

    public function estudiante(){
        return $this->belongsTo('App\Models\Estudiante','estudiante_id');
    }
}
