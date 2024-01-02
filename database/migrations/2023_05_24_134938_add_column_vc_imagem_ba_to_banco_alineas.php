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
        Schema::table('banco_alineas', function (Blueprint $table) {
            //vc_imagem_ba
            $table->string('vc_imagem_ba')->nullable();
            $table->string('vc_codigo_ba')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banco_alineas', function (Blueprint $table) {
            //
        });
    }
};
