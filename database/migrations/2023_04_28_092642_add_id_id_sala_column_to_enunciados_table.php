<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enunciados', function (Blueprint $table) {
            // $table->unsignedBigInteger('it_id_sala')->nullable();
            // $table->foreign('it_id_sala')->references('id')->on('salas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enunciados', function (Blueprint $table) {
            //
        });
    }
};
