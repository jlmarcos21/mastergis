<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        App\Level::create([
            'description'   => '1 Nivel',
            'colour'        => '#5ADF39'
        ]);

        App\Level::create([
            'description'   => '2 Niveles',
            'colour'        => '#39DFBE'
        ]);

        App\Level::create([
            'description'   => '3 Niveles',
            'colour'        => '#395ADF'
        ]);

    }
}
