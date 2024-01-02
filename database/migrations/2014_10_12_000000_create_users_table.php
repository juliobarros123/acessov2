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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('vc_primeiro_nome')->nullable();
            $table->string('vc_nome_meio')->nullable();
            $table->string('vc_ultimo_nome')->nullable();
            $table->text('vc_imagem', 255)->nullable();
            $table->string('numero_bi')->unique()->default('vazio');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('it_tipo_usuario')->default('1');
            $table->foreign('it_tipo_usuario')->references('id')->on('tipo_users')->onDelete('cascade')->onUpdate('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
