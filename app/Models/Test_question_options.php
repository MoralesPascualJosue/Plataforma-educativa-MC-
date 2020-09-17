<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test_question_options extends Model
{
    use SoftDeletes;

    public $table = 'test_question_options';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'option',
        'answer',
        'question_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'option' => 'string',
        'answer' => 'string',
        'question_id' => 'integer'
    ];

    public function question(){
        return $this->belongsTo('App\Models\Test_questions','question_id');
    }
}
