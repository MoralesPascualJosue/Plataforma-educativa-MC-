<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_question_options', function (Blueprint $table) {
            $table->increments('id');
            $table->text('option');
            $table->integer('answer');
            $table->integer('question_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('question_id')->references('id')->on('test_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_question_options');
    }
}
