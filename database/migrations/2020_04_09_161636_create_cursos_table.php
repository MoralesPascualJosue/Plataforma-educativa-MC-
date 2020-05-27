<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCursosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('review');
            $table->string('cover');
            $table->integer('asesor_id')->unsigned();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('asesor_id')->references('id')->on('asesors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cursos');
    }
}
