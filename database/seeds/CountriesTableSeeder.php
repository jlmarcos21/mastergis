<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Crear Paises

        App\Country::create([
            'description' => 'Perú',
            'flag' => 'flag-icon flag-icon-pe'
        ]);

        App\Country::create([
            'description' => 'México',
            'flag' => 'flag-icon flag-icon-mx'
        ]);

        App\Country::create([
            'description' => 'Argentina',
            'flag' => 'flag-icon flag-icon-ar'
        ]);

        App\Country::create([
            'description' => 'Brasil',
            'flag' => 'flag-icon flag-icon-br'
        ]);

        App\Country::create([
            'description' => 'Chile',
            'flag' => 'flag-icon flag-icon-cl'
        ]);

        App\Country::create([
            'description' => 'Colombia',
            'flag' => 'flag-icon flag-icon-co'
        ]);

        App\Country::create([
            'description' => 'España',
            'flag' => 'flag-icon flag-icon-es'
        ]);

        App\Country::create([
            'description' => 'Paraguay',
            'flag' => 'flag-icon flag-icon-py'
        ]);

        App\Country::create([
            'description' => 'Ecuador',
            'flag' => 'flag-icon flag-icon-ec'
        ]);

        App\Country::create([
            'description' => 'Uruguay',
            'flag' => 'flag-icon flag-icon-uy'
        ]);

        App\Country::create([
            'description' => 'Canadá',
            'flag' => 'flag-icon flag-icon-ca'
        ]);

        App\Country::create([
            'description' => 'Cuba',
            'flag' => 'flag-icon flag-icon-cu'
        ]);

        App\Country::create([
            'description' => 'República Dominicana',
            'flag' => 'flag-icon flag-icon-do'
        ]);

        App\Country::create([
            'description' => 'Honduras',
            'flag' => 'flag-icon flag-icon-hn'
        ]);

        App\Country::create([
            'description' => 'Bolivia',
            'flag' => 'flag-icon flag-icon-bo'
        ]);

        App\Country::create([
            'description' => 'Venezuela',
            'flag' => 'flag-icon flag-icon-ve'
        ]);

        App\Country::create([
            'description' => 'Panama',
            'flag' => 'flag-icon flag-icon-pa'
        ]);

        App\Country::create([
            'description' => 'Costa Rica',
            'flag' => 'flag-icon flag-icon-cr'
        ]);

        App\Country::create([
            'description' => 'Guatemala',
            'flag' => 'flag-icon flag-icon-gt'
        ]);

        App\Country::create([
            'description' => 'EEUU',
            'flag' => 'flag-icon flag-icon-us'
        ]);

        App\Country::create([
            'description' => 'Portugal',
            'flag' => 'flag-icon flag-icon-pt'
        ]);
    }
}
