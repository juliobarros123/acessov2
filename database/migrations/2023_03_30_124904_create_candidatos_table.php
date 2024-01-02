
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
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();
            $table->string('vc_primeiro_nome');
            $table->string('vc_nome_meio');
            $table->string('vc_ultimo_nome');
            $table->unsignedBigInteger('it_id_classe');
            $table->foreign('it_id_classe')->references('id')->on('classes')->onDelete('cascade')->onUpdate('cascade');
            $table->date('dt_data_nascimento');
            $table->string('vc_naturalidade');
            $table->string('vc_provincia');
            $table->string('vc_nome_pai');
            $table->string('vc_nome_mae');
            $table->string('vc_deficiencia');
            $table->string('vc_estado_civil');
            $table->string('vc_genero');
            $table->integer('it_telefone');
            $table->string('vc_email');
            $table->string('vc_residencia');
            $table->string('vc_bi');
            $table->date('dt_data_emissao');
            $table->string('vc_local_emissao');
            $table->string('vc_escola_anterior');
            $table->year('ya_ano_conclusao');
            //$table->string('vc_nome_curso');
            $table->date('dt_ano_candidatura');
            $table->integer('it_media');
            $table->unsignedBigInteger('it_id_ano_lectivo');
            $table->foreign('it_id_ano_lectivo')->references('id')->on('ano_lectivos')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('it_estado_aluno')->default('1');
            $table->integer('it_idade');
            $table->unsignedBigInteger('it_id_sala');
            $table->foreign('it_id_sala')->references('id')->on('salas')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('it_id_periodo');
            $table->foreign('it_id_periodo')->references('id')->on('periodos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('vc_foto')->nullable();
            $table->string('vc_codigo')->nullable();
            $table->unsignedBigInteger('it_id_curso');
            $table->foreign('it_id_curso')->references('id')->on('cursos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('candidatos');
    }
};
