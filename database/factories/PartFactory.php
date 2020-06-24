<?php

$factory->define(App\Part::class, function (Faker\Generator $faker) {
    return [
        "repair_center_id" => factory('App\Workshop')->create(),
        "part" => $faker->name,
        "qty" => $faker->randomFloat(2, 1, 100),
        "unit_id" => factory('App\UnitMeasurement')->create(),
        "status" => collect(["Available","Unavailable","Required",])->random(),
    ];
});
