<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('instructions');
            $table->string('type');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->integer('visible');
            $table->integer('result_release');
            $table->integer('num_takes');
            $table->integer('curso_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('curso_id')->references('id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
