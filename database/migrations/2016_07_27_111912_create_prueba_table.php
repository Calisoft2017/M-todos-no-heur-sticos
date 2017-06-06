<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePruebaTable extends Migration
{
    public function up()
    {
        Schema::create('prueba',function(Blueprint $table){
            $table->increments('id_prueba');
            $table->bigInteger('id_casoPrueba');
            $table->text('name_Prueba');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('prueba');
    }
}
