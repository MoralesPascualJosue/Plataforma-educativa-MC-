<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionAnsweredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_question_answered', function (Blueprint $table) {
            $table->increments('id');
            $table->text('answer');
            $table->integer('qualification');
            $table->text('notes');
            $table->integer('question_id')->unsigned();
            $table->integer('estudiante_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('question_id')->references('id')->on('test_questions');            
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_question_answered');
    }
}
