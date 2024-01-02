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
        Schema::table('provas', function (Blueprint $table) {
            
            $table->integer('capacidade_usada')->default(0);
            $table->unsignedBigInteger('it_id_curso')->nullable();
            $table->foreign('it_id_curso')->references('id')->on('cursos')->onDelete('cascade')->onUpdate('cascade');            
            $table->unsignedBigInteger('it_id_ano_lectivo')->nullable();
            $table->foreign('it_id_ano_lectivo')->references('id')->on('ano_lectivos')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('it_id_horario')->nullable();
            $table->foreign('it_id_horario')->references('id')->on('horarios')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provas', function (Blueprint $table) {
            $table->dropForeign(['it_id_horario']);
            $table->dropForeign(['it_id_curso']); 
            $table->dropForeign(['it_id_ano_lectivo']); 
            $table->dropColumn('it_id_horario');  
            $table->dropColumn('it_id_curso');
            $table->dropColumn('capacidade_usada');
            $table->dropColumn('it_id_ano_lectivo'); 
        });
    }
};
