<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'      => 'Administrador',
            'email'     => 'admin@mastergis.com',
            'password'  => bcrypt('admin')
        ]);

        App\User::create([
            'name'      => 'Renzo',
            'email'     => 'renzo@mastergis.com',
            'password'  => bcrypt('renzo123')
        ]);
    }
}
