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

        //1
        App\SubLevel::create([
            'description'   => 'NULO',
            'colour'        => '#8E8988'
        ]);

        //2
        App\SubLevel::create([
            'description'   => 'BÁSICO',
            'colour'        => '#7eb530'
        ]);

        //3
        App\SubLevel::create([
            'description'   => 'INTERMEDIO',
            'colour'        => '#eec207'
        ]);

        //4
        App\SubLevel::create([
            'description'   => 'AVANZADO',
            'colour'        => '#c10012'
        ]);
        
    }
}
