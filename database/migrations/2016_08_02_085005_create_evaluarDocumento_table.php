<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluarDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluarDocumento',function(Blueprint $table){
            $table->increments('id_evaluar_documento');
            $table->integer('id_documentos_proyecto');
            $table->string('check');
            $table->string('observaciones');
            $table->integer('id_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('evaluarDocumento');
    }
}
