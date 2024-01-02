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
        Schema::create('alinea_geradas', function (Blueprint $table) {
            $table->id();
            $table->string('alinea');
            $table->unsignedBigInteger('it_id_pergunta');
            $table->foreign('it_id_pergunta')->references('id')->on('perguntas')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('it_id_banco_alinea');
            $table->foreign('it_id_banco_alinea')->references('id')->on('banco_alineas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alinea_geradas');
    }
};
