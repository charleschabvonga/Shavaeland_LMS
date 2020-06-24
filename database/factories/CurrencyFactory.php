<?php

$factory->define(App\Currency::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "symbol" => $faker->name,
    ];
});
