<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Nuestro roles
        $r_admin = Role::where('slug', 'admin')->first();
        $r_marketing = Role::where('slug', 'marketing')->first();
        $r_accounting = Role::where('slug', 'accounting')->first();
        $r_project = Role::where('slug', 'project-review')->first();

        $user = new User();
        $user->name = 'Administrador';
        $user->email = 'admin@mastergis.com';
        $user->password = bcrypt('admin123');
        $user->save();
        $user->roles()->attach($r_admin);


        $user = new User();
        $user->name = 'Renzo Trujillo';
        $user->email = 'renzo@mastergis.com';
        $user->password = bcrypt('renzo123');
        $user->save();
        $user->roles()->attach($r_marketing);        

        $user = new User();
        $user->name = 'Lesly Roque';
        $user->email = 'lesly@mastergis.com';
        $user->password = bcrypt('lesly123');
        $user->save();
        $user->roles()->attach($r_accounting);

        $user = new User();
        $user->name = 'Malu Lope';
        $user->email = 'malu@mastergis.com';
        $user->password = bcrypt('malu123');
        $user->save();
        $user->roles()->attach($r_project);

    }
}
