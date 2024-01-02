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
        Schema::create('perguntas', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->unsignedBigInteger('it_id_banco_pergunta');
            $table->foreign('it_id_banco_pergunta')->references('id')->on('banco_perguntas')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('it_id_enunciado');
            $table->foreign('it_id_enunciado')->references('id')->on('enunciados')->onDelete('cascade')->onUpdate('cascade');;
            $table->string('ch_alinea');
          
            $table->integer('it_numero');
              $table->integer('it_cotacao')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('perguntas');
    }
};
