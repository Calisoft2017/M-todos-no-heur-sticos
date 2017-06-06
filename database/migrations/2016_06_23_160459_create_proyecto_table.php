<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoTable extends Migration
{
    public function up()
    {
        Schema::create('proyecto',function(Blueprint $table){
            $table->increments('id_proyecto');
            $table->text('name_proyecto');
            $table->text('name_investigacion');
            $table->text('name_semillero');
            $table->bigint('id_categoria');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('proyecto');
    }
}
