<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folha_respostas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('it_id_enunciado');
            $table->unsignedBigInteger('it_id_candidato');
            $table->unsignedBigInteger('it_id_ano_lectivo');
            $table->SoftDeletes();
            $table->timestamps();
            $table->foreign('it_id_enunciado')->references('id')->on('enunciados')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('it_id_candidato')->references('id')->on('candidatos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('it_id_ano_lectivo')->references('id')->on('ano_lectivos')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folha_respostas');
    }
};
