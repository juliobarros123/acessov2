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
        Schema::table('banco_perguntas', function (Blueprint $table) {
            //
            $table->string('vc_imagem_bp')->nullable();
            $table->string('vc_codigo_bp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banco_perguntas', function (Blueprint $table) {
            //
        });
    }
};
