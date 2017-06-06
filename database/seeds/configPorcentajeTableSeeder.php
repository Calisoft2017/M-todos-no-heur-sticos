<?php

use Illuminate\Database\Seeder;

class configPorcentajeTableSeeder extends Seeder
{
    public function run()
    {
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'porcPlataforma',
    	'valor'=>50,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'porcModelado',
    	'valor'=>50,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'prioridadAlta',
    	'valor'=>5,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'prioridadMedia',
    	'valor'=>3,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'prioridadBaja',
    	'valor'=>2,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'dClases',
    	'valor'=>15,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'dCasos',
    	'valor'=>15,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'dDespliegue',
    	'valor'=>15,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'dSecuencias',
    	'valor'=>15,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'dActividades',
    	'valor'=>15,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'MER',
    	'valor'=>25,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'numeroUsuarios',
    	'valor'=>10,
    	]);
         DB::table('configPorcentaje')->insert([
    	'name_campo'=>'tiempo',
    	'valor'=>10,
    	]);
    }
}
