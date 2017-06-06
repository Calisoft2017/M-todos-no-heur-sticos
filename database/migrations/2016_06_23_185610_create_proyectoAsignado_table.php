<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoAsignadoTable extends Migration
{
    public function up()
    {
        Schema::create('proyectoAsignado',function(Blueprint $table){
            $table->increments('id_proyectoAsignado');
            $table->integer('id_usuario');
            $table->integer('id_proyecto');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('proyectoAsignado');
    }
}
