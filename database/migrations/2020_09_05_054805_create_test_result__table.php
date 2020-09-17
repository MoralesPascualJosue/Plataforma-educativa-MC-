<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_result', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state');
            $table->integer('result');
            $table->date('taken_date');
            $table->integer('test_id')->unsigned();
            $table->integer('estudiante_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('test_id')->references('id')->on('tests');       
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
        Schema::dropIfExists('test_result');
    }
}
