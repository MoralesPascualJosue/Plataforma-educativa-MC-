<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test_result extends Model
{
    use SoftDeletes;

    public $table = 'test_result';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'result',
        'taken_date',
        'state',
        'test_id',
        'estudiante_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'result' => 'integer',
        'taken_date' => 'date:Y-m-d',
        'state',
        'test_id' => 'integer',
        'estudiante_id' => 'integer'
    ];

    public function test(){
        return $this->belongsTo('App\Models\Test','test_id');
    }

    public function estudiante(){
        return $this->belongsTo('App\Models\Estudiante','estudiante_id');
    }
}
