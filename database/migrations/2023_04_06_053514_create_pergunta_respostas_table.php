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
        Schema::create('pergunta_respostas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('it_id_correcao');
            $table->foreign('it_id_correcao')->references('id')->on('correcaos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('it_id_pergunta');
            $table->foreign('it_id_pergunta')->references('id')->on('perguntas')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('it_id_banco_alinea');
            $table->foreign('it_id_banco_alinea')->references('id')->on('banco_alineas')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('chave');
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
        Schema::dropIfExists('pergunta_respostas');
    }
};
