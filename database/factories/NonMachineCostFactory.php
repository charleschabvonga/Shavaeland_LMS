<?php

$factory->define(App\NonMachineCost::class, function (Faker\Generator $faker) {
    return [
        "road_freight_number_id" => factory('App\RoadFreight')->create(),
        "item_description" => $faker->name,
        "qty" => $faker->randomFloat(2, 1, 100),
        "cost" => $faker->randomNumber(2),
        "unit" => $faker->name,
        "total" => $faker->randomNumber(2),
    ];
});
