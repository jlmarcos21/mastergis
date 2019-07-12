<?php

use Illuminate\Database\Seeder;

class InterestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Interest::create([
            'name' => 'Categoría 1',
            'colour' => '#00D80D',
            'stars' => '<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>'
        ]);
        App\Interest::create([
            'name' => 'Categoría 2',
            'colour' => '#FF5900',
            'stars' => '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>'
        ]);
        App\Interest::create([
            'name' => 'Categoría 3',
            'colour' => '#FF0000',
            'stars' => '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>'
        ]);
    }
}
