<?php

$factory->define(App\FuelCost::class, function (Faker\Generator $faker) {
    return [
        "receipt_number" => $faker->name,
        "road_freight_number_id" => factory('App\RoadFreight')->create(),
        "vehicle_id" => factory('App\Vehicle')->create(),
        "description" => $faker->name,
        "qty" => $faker->randomFloat(2, 1, 100),
        "cost" => $faker->randomNumber(2),
        "unit" => $faker->name,
        "total" => $faker->randomNumber(2),
        "currency_id" => factory('App\Currency')->create(),
    ];
});
