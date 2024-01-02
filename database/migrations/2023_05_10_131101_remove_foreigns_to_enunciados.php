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
        Schema::table('enunciados', function (Blueprint $table) {
            // $table->dropColumn('it_id_periodo');
            // $table->dropForeign(['it_id_periodo']);
            // $table->dropColumn('id_ano_lectivo');
         
            // $table->dropForeign(['id_ano_lectivo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enunciados', function (Blueprint $table) {
            //
        });
    }
};
