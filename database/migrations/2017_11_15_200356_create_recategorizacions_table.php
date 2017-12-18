<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecategorizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recategorizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cambio_id')->unsigned()->nullable();
            $table->foreign('cambio_id')->references('id')->on('cambios');
            $table->integer('inicial_categoria_id')->unsigned()->nullable();
            $table->foreign('inicial_categoria_id')->references('id')->on('inicial_categorias');
            $table->integer('final_categoria_id')->unsigned()->nullable();
            $table->foreign('final_categoria_id')->references('id')->on('final_categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recategorizacions');
    }
}
