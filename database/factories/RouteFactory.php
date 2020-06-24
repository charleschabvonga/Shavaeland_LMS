<?php

$factory->define(App\Route::class, function (Faker\Generator $faker) {
    return [
        "route" => $faker->name,
        "distance" => $faker->randomFloat(2, 1, 100),
    ];
});
