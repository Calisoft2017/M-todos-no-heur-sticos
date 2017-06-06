<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration
{
    public function up()
    {
        Schema::create('usuario',function(Blueprint $table){
            $table->bigInteger('id_usuario');
            $table->integer('id_rol');
            $table->text('nombre');
            $table->text('apellido');
            $table->text('correo');
            $table->text('nom_usuario');
            $table->text('contrasena');
            $table->text('estado');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::drop('usuario');
    }
}
