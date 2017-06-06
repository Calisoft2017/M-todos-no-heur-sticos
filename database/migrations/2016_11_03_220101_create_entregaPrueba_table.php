<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregaPruebaTable extends Migration
{
    public function up()
    {
        Schema::create('entregaPrueba',function(Blueprint $table){
            $table->increments('id_entregaPrueba');
            $table->integer('id_prueba');
            $table->integer('n_entrega');
            $table->string('estado');
            $table->string('observacion');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('entregaPrueba');
    }
}
