<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Contact::create([
            'description'   => 'FB Messenger',
            'icon'          => 'fab fa-facebook-messenger'
        ]);

        App\Contact::create([
            'description'   => 'Whatsapp',
            'icon'          => 'fab fa-whatsapp'
        ]);

        App\Contact::create([
            'description'   => 'Correo',
            'icon'          => 'far fa-envelope'
        ]);
        
        App\Contact::create([
            'description'   => 'Llamada',
            'icon'          => 'fas fa-phone'
        ]);
    }
}
