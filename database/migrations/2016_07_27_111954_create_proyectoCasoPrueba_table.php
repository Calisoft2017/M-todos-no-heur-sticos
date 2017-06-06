<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoCasoPruebaTable extends Migration
{
    public function up()
    {
        Schema::create('proyectoCasoPrueba',function(Blueprint $table){
            $table->increments('id_proyectoCasoPrueba');
            $table->bigInteger('id_proyecto');
            $table->bigInteger('id_casoPrueba');
            $table->bigInteger('id_usuario');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('proyectoCasoPrueba');
    }
}
