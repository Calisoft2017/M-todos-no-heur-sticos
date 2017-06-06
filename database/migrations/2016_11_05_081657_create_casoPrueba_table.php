<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasoPruebaTable extends Migration
{
    public function up()
    {
        Schema::create('casoPrueba',function(Blueprint $table){
            $table->increments('id_casoPrueba');
            $table->text('name_casoPrueba');
            $table->text('proposito');
            $table->text('objetivo');
            $table->text('alcance');
            $table->text('resultadoEsperado');
            $table->text('criteriosEvaluacion');
            $table->string('prioridad');
            $table->timestamp('fecha_limite');
            $table->text('txt');
            $table->text('url');
            $table->text('observacionEstudiante');
            $table->text('conclucion');
            $table->text('estado');
            $table->integer('entrega');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('casoPrueba');
    }
}
