<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referente_id')->unsigned()->nullable();
            $table->foreign('referente_id')->references('id')->on('referentes');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('lengua_id')->unsigned()->nullable();
            $table->foreign('lengua_id')->references('id')->on('lenguas');
            $table->integer('tipo_id')->unsigned()->nullable();
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->string('palabra');
            $table->string('definicion', 1000);
            $table->integer('anno_testimonio')->nullable();
            $table->integer('siglo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cambios');
    }
}
