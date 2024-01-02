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
        Schema::create('curso_disciplinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('it_id_disciplina')->nullable();
            $table->foreign('it_id_disciplina')->references('id')->on('disciplinas')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('it_id_curso')->nullable();
            $table->foreign('it_id_curso')->references('id')->on('cursos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('curso_disciplinas');
    }
};
