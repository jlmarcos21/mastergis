<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Currency::create([
            'name' => 'PEN',
            'icon' => 'S/',
            'flag' => 'flag-icon flag-icon-pe'
        ]);

        App\Currency::create([
            'name' => 'USD',            
            'icon' => '$',
            'flag' => 'flag-icon flag-icon-us'
        ]);
    }
}
