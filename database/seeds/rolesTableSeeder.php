<?php

use Illuminate\Database\Seeder;

class rolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('rol')->insert([
    	'name_rol'=>'Administrador',
    	]);
         DB::table('rol')->insert([
    	'name_rol'=>'Evaluador',
    	]);
         DB::table('rol')->insert([
    	'name_rol'=>'Estudiante',
    	]);
    }
}
