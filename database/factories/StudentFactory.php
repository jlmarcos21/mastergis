<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Student::class, function (Faker $faker) {

    $name = $faker->unique()->name.rand(1, 100);
    $lastname = $faker->unique()->lastname.rand(1, 100);
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
