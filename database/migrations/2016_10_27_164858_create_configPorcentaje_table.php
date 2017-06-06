<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigPorcentajeTable extends Migration
{
    public function up()
    {
        Schema::create('configPorcentaje',function(Blueprint $table){
            $table->increments('id_campo');
            $table->string('name_campo');
            $table->integer('valor');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('configPorcentaje');
    }
}
