<?php

use Illuminate\Database\Seeder;

class TipodocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('tipoDocumento')->insert([
    	'nom_tipo'=>'Diagrama de clases',
    	'opcional_tipo'=>'NO',
    	]);
         DB::table('tipoDocumento')->insert([
    	'nom_tipo'=>'Diagrama de casos de uso',
    	'opcional_tipo'=>'NO',
    	]);
         DB::table('tipoDocumento')->insert([
    	'nom_tipo'=>'Diagrama de secuencias',
    	'opcional_tipo'=>'NO',
    	]);
         DB::table('tipoDocumento')->insert([
    	'nom_tipo'=>'Diagrama de actividades',
    	'opcional_tipo'=>'NO',
    	]);
         DB::table('tipoDocumento')->insert([
    	'nom_tipo'=>'Diagrama de despliegue',
    	'opcional_tipo'=>'NO',
    	]);
         DB::table('tipoDocumento')->insert([
    	'nom_tipo'=>'Modelo Entidad Relación',
    	'opcional_tipo'=>'NO',
    	]);

         DB::table('tipoDocumento')->insert([
        'nom_tipo'=>'Anexos',
        'opcional_tipo'=>'SI',
        ]);
    }
}
