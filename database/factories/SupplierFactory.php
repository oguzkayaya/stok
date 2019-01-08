<?php

use Faker\Generator as Faker;
use App\Supplier;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'telephone' => $faker->e164PhoneNumber,
    ];
});
