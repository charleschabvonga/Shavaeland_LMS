<?php

$factory->define(App\UnitMeasurement::class, function (Faker\Generator $faker) {
    return [
        "measurement_type" => $faker->name,
    ];
});
