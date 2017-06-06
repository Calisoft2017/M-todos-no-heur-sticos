<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaTable extends Migration
{
     public function up()
    {
        Schema::create('categoria',function(Blueprint $table){
            $table->increments('id_categoria');
            $table->string('name_categoria');
            $table->integer('porcPlataforma');
            $table->integer('porcModelado');
            $table->integer('prioridadAlta');
            $table->integer('prioridadMedia');
            $table->integer('prioridadBaja');
            $table->integer('dClases');
            $table->integer('dCasos');
            $table->integer('dDespliegue');
            $table->integer('dSecuencias');
            $table->integer('dActividades');
            $table->integer('MER');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('categoria');
    }
}
