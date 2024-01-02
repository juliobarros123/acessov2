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
        Schema::create('banco_perguntas', function (Blueprint $table) {
            $table->id();
            $table->string('vc_descricao_bp');
            $table->integer('it_cotacao');
            $table->unsignedBigInteger('it_id_ano_lectivo');
            $table->foreign('it_id_ano_lectivo')->references('id')->on('ano_lectivos')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('it_id_disciplina');
            $table->foreign('it_id_disciplina')->references('id')->on('disciplinas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('banco_perguntas');
    }
};
