<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFpostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fposts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->integer('locked');
            $table->integer('fdiscusion_id')->unsigned();
	    $table->bigInteger('user_id')->unsigned();	    
	    $table->integer('parent')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('fdiscusion_id')->references('id')->on('fdiscusions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fposts');
    }
}
