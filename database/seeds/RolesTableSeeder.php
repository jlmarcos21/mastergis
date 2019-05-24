<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        App\Role::create([
            'name'          => 'ADMIN',
            'slug'          => str_slug('ADMIN'),
            'description'   => 'Administrador del Sistema'
        ]);

        App\Role::create([
            'name'          => 'Marketing',
            'slug'          => str_slug('Marketing'),
            'description'   => 'Se encarga de Revisar los Proyectos'
        ]);

        App\Role::create([
            'name'          => 'Accounting',
            'slug'          => str_slug('Accounting'),
            'description'   => 'Se encarga de crear Certificados y reporte de ventas'
        ]);

        App\Role::create([
            'name'          => 'Project Review',
            'slug'          => str_slug('Project Review'),
            'description'   => 'Se encarga de Revisar los Proyectos'
        ]);
    }
}
