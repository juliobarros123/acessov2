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
            $table->unsignedBigInteger('it_id_prova')->nullable();
            $table->foreign('it_id_prova')->references('id')->on('provas')->onDelete('cascade')->onUpdate('cascade');
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
