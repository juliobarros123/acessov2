<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoUsersTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
            $table->softDeletes(); 
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_users');
    }
}
