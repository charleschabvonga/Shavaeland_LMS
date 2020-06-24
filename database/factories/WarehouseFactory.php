<?php

$factory->define(App\Warehouse::class, function (Faker\Generator $faker) {
    return [
        "vendor_id" => factory('App\Vendor')->create(),
        "center_name" => $faker->name,
        "square_meters" => $faker->randomFloat(2, 1, 100),
        "available_space" => $faker->randomFloat(2, 1, 100),
    ];
});
