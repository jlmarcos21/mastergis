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

        //por Defecto
        App\Agency::create([
            'payment_m_id'    => '1',
            'name'          => 'Sin Agente',
            'icon'          => 'fas fa-times'
        ]);

        App\PaymentM::create([
            'name' => 'PayPal',
            'icon' => 'fab fa-cc-paypal'
        ]);

        App\PaymentM::create([
            'name' => 'Giro',
            'icon' => 'far fa-handshake'
        ]);

        //Agencia para giros
        App\Agency::create([
            'payment_m_id'    => '3',
            'name'          => 'Western Union',
            'icon'          => 'far fa-money-bill-alt'
        ]);
        
        App\Agency::create([
            'payment_m_id'    => '3',
            'name'          => 'Money Gram',
            'icon'          => 'fas fa-file-invoice-dollar'
        ]);

        App\PaymentM::create([
            'name' => 'Deposito',
            'icon' => 'fas fa-hand-holding-usd'
        ]);

        //Agencia para deposito
        App\Agency::create([
            'payment_m_id'    => '4',
            'name'          => 'BCP',
            'icon'          => 'fab fa-cc-visa'
        ]);
        
        App\Agency::create([
            'payment_m_id'    => '4',
            'name'          => 'BBVA',
            'icon'          => 'fab fa-cc-visa'
        ]);
    }
}
