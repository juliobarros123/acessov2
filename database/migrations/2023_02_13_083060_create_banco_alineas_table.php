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
        Schema::create('banco_alineas', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('it_id_banco_pergunta');
            $table->foreign('it_id_banco_pergunta')->references('id')->on('banco_perguntas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('chave');
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
        Schema::dropIfExists('banco_alineas');
    }
};
