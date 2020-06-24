<?php

$factory->define(App\OperationType::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
