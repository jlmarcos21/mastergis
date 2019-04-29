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
            'name'      => 'JL Marcos',
            'email'     => 'jlmarcos@mastergis.com',
            'password'  => bcrypt('admin')
        ]);
    }
}
