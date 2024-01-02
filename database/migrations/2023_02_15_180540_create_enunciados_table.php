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
        Schema::create('enunciados', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('vc_coordenador');
            $table->unsignedBigInteger('it_id_disciplina');
            $table->foreign('it_id_disciplina')->references('id')->on('disciplinas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('enunciados');
    }
};
