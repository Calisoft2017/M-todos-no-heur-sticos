<?php

use Illuminate\Database\Seeder;

class categoriaTableSeeder extends Seeder
{
    public function run()
    {
         DB::table('categoria')->insert([
    	'name_categoria'=>'sistemas de informacion',
    	'porcPlataforma'=>50,
    	'porcModelado'=>50,
    	'prioridadAlta'=>5,
    	'prioridadMedia'=>3,
    	'prioridadBaja'=>2,
    	'dClases'=>15,
    	'dCasos'=>15,
    	'dDespliegue'=>15,
    	'dSecuencias'=>15,
    	'dActividades'=>15,
    	'MER'=>25,
    	]);
         
    }
}
