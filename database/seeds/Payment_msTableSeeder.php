<?php

use Illuminate\Database\Seeder;

class Payment_msTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PaymentM::create([
            'name' => 'Tarjeta de Credito',
            'icon' => 'far fa-credit-card'
        ]);

        App\PaymentM::create([
            'name' => 'PayPal',
            'icon' => 'fab fa-cc-paypal'
        ]);

        App\PaymentM::create([
            'name' => 'Giro',
            'icon' => 'far fa-handshake'
        ]);

        App\PaymentM::create([
            'name' => 'Deposito',
            'icon' => 'fas fa-hand-holding-usd'
        ]);
    }
}
