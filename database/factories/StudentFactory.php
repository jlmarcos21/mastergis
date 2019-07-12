<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Student::class, function (Faker $faker) {

    $name = $faker->unique()->name;
    $lastname = $faker->unique()->lastname;
    $country_id = App\Country::inRandomOrder()->first()->id;

    return [
        'code'          => str_slug(Str::substr($lastname, 0, 2).Str::substr($name, 0, 2).(rand(1, 100))),
        'name'          => $name,
        'lastname'      => $lastname,
        'sex'           => $faker->randomElement(['Masculino', 'Femenino']),        
        'country_id'    => $country_id,
        'province_id'   => App\Province::inRandomOrder()->where('country_id', $country_id)->first()->id, 
        'email'         => rand(1, 9).$faker->safeEmail,
        'phone'         => $faker->phoneNumber,
        'state'         => 1
    ];
});
