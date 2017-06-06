<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoDocumentoTable extends Migration
{
    public function up()
    {
        Schema::create('tipoDocumento',function(Blueprint $table){
            $table->increments('id_tipo_documento');
            $table->string('nom_tipo');
            $table->string('opcional_tipo');
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
        Schema::drop('tipoDocumento');
    }
}
