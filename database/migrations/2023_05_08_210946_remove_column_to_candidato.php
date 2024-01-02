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
        Schema::table('candidatos', function (Blueprint $table) {
            $table->dropForeign(['it_id_periodo']);
            $table->dropForeign(['it_id_sala']); 
            $table->dropColumn('it_id_periodo');  
            $table->dropColumn('it_id_sala'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidato', function (Blueprint $table) {
            //
        });
    }
};
