<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoComponenteTable extends Migration
{
    public function up()
    {
        Schema::create('documentoComponente',function(Blueprint $table){
            $table->increments('id_documento_componente');
            $table->string('nom_componente');
            $table->string('opcional_componente');
            $table->string('descripcion');
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
        Schema::drop('documentoComponente');
    }

}
