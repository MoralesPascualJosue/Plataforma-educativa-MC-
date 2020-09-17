<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->string('type');
            $table->text('feedback');
            $table->integer('curso_id')->unsigned();
            $table->integer('test_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->foreign('test_id')->references('id')->on('tests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_questions');
    }
}
