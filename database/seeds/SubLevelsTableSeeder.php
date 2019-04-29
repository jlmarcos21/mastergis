<?php

use Illuminate\Database\Seeder;

class SubLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        App\SubLevel::create([
            'description'   => 'Basico',
            'colour'        => '#7eb530'
        ]);

        App\SubLevel::create([
            'description'   => 'Intermedio',
            'colour'        => '#eec207'
        ]);

        App\SubLevel::create([
            'description'   => 'Avanzado',
            'colour'        => '#c10012'
        ]);
        
    }
}
