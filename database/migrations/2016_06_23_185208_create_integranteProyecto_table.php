<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegranteProyectoTable extends Migration
{
    public function up()
    {
        Schema::create('integranteProyecto',function(Blueprint $table){
            $table->increments('id_integranteProyecto');
            $table->integer('id_proyecto');
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('integranteProyecto');
    }
}
