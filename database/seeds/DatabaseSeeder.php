<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Eloquent::unguard();
        $this->call('TipodocumentoTableSeeder');
        $this->command->info('Tipo documento insertados!');

        $this->call('ComponenteTableSeeder');
        $this->command->info('Componentes insertados!');

        $this->call('rolesTableSeeder');
        $this->command->info('Roles insertados!');

        $this->call('administradorTableSeeder');
        $this->command->info('Administrador insertados!');

        $this->call('configPorcentajeTableSeeder');
        $this->command->info('porcentajes insertados!');

        $this->call('categoriaTableSeeder');
        $this->command->info('categoria insertados!');
    }
}
