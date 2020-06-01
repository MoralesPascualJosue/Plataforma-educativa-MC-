<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->text('contenido');
            $table->integer('entregas');
            $table->integer('activitie_id')->unsigned();
            $table->integer('estudiante_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('activitie_id')->references('id')->on('activities');
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
        Schema::drop('works');
    }
}
