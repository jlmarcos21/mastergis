<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Student::class, function (Faker $faker) {

    $name = $faker->unique()->name;
    $lastname = $faker->unique()->lastname;
    $id = 1;

    return [
        'code'          => str_slug(Str::substr($lastname, 0, 2).Str::substr($name, 0, 2).(rand(1, 9))),
        'name'          => $name,
        'lastname'      => $lastname,
        'sex'           => $faker->randomElement(['MASCULINO', 'FEMENINO']),
        'nationality'   => $faker->randomElement(['EXTRANJERO', 'NACIONAL']),
        'country_id'    => App\Country::inRandomOrder()->first()->id,   
        'email'         => $faker->unique()->safeEmail,
        'phone'         => $faker->unique()->phoneNumber,
        'state'         => 1
    ];
});
