<?php

use Illuminate\Database\Seeder;

class administradorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('usuario')->insert([
    	'id_usuario'=>1,
    	'id_rol'=>1,
    	'nombre'=>'universidad',
    	'apellido'=>'cundinamarca',
    	'correo'=>'Administrador',
    	'nom_usuario'=>'unicundi',
    	'contrasena'=>encrypt('unicundi'),
    	'estado'=>'activo',
    	]);
    }
}
