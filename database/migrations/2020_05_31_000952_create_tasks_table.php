<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->json('contenido')->nulleable();
            $table->integer('asesor_id')->unsigned();
            $table->integer('activitie_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('asesor_id')->references('id')->on('asesors');
            $table->foreign('activitie_id')->references('id')->on('activities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
