<?php

$factory->define(App\LoadDescription::class, function (Faker\Generator $faker) {
    return [
        "description" => $faker->name,
        "qty" => $faker->randomFloat(2, 1, 100),
        "weight_volume" => $faker->randomFloat(2, 1, 100),
        "loading_instruction_number_id" => factory('App\LoadingInstruction')->create(),
        "delivery_instruction_number_id" => factory('App\DeliveryInstruction')->create(),
        "air_freight_number_id" => factory('App\AirFreight')->create(),
        "rail_freight_number_id" => factory('App\RailFreight')->create(),
        "sea_freight_number_id" => factory('App\SeaFreight')->create(),
    ];
});
