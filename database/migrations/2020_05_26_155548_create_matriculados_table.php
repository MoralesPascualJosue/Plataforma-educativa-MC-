<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatriculadosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estudiante_id')->unsigned();
            $table->integer('curso_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
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
        Schema::drop('matriculados');
    }
}
