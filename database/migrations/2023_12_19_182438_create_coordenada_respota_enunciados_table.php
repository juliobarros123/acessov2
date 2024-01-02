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
        Schema::create('coordenada_respota_enunciados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('it_id_enunciado');
            $table->foreign('it_id_enunciado')->references('id')->on('enunciados')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('x');
            $table->string('y');
       
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
        Schema::dropIfExists('coordenada_respota_enunciados');
    }
};
