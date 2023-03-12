<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	[
                'nombre' => 'Admin',
                'descripcion' => 'Rol del administrador',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        	],
        	[
                'nombre' => 'Jefe',
                'descripcion' => 'Rol del jefe',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        	],
            [
                'nombre' => 'Empleado',
                'descripcion' => 'Rol del trabajador',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        	],
            [
                'nombre' => 'Cliente',
                'descripcion' => 'Rol del usuario cliente',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        	],
        ]);
    }
}
