<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolTable extends Migration
{
    public function up()
    {
        Schema::create('rol',function(Blueprint $table){
            $table->increments('id_rol');
            $table->string('name_rol');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('rol');
    }
}
