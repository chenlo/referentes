<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecategorizacionIdColumnToCambios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cambios', function (Blueprint $table) {
            $table->integer('recategorizacion_id')->unsigned()->nullable();
            $table->foreign('recategorizacion_id')->references('id')->on('cambios');
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cambios', function (Blueprint $table) {
            $table->dropColumn('recategorizacion_id');
        });  
    }
}
