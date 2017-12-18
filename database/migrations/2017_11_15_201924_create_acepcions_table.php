<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcepcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acepcions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('palabra');
            $table->integer('cambio_id')->unsigned()->nullable();
            $table->foreign('cambio_id')->references('id')->on('cambios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acepcions');
    }
}
