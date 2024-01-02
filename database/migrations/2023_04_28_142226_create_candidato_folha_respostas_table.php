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
        Schema::create('candidato_folha_respostas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('it_id_candidato');
            $table->foreign('it_id_candidato')->references('id')->on('candidatos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('it_id_enunciado');
            $table->foreign('it_id_enunciado')->references('id')->on('enunciados')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->SoftDeletes();
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
        Schema::dropIfExists('candidato_folha_respostas');
    }
};
