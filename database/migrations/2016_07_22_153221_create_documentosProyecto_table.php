<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentosProyecto',function(Blueprint $table){
            $table->increments('id_documentos_proyecto');
            $table->string('nombre_documento');
            $table->string('url_documento');
            $table->integer('id_proyecto');
            $table->integer('id_tipo_documento');
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
        Schema::drop('documentosProyecto');
    }
}
