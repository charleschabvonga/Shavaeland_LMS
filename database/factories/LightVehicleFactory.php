<?php

$factory->define(App\LightVehicle::class, function (Faker\Generator $faker) {
    return [
        "vehicle_type" => collect(["Truck","Bukkie","Twin cab","Light passenger",])->random(),
        "vehicle_description" => $faker->name,
        "make" => $faker->name,
        "model" => $faker->name,
        "purchase_date" => $faker->date("Y-m-d", $max = 'now'),
        "purchase_price" => $faker->randomNumber(2),
        "chasis_number" => $faker->name,
        "engine_number" => $faker->name,
        "size_id" => factory('App\MachinerySize')->create(),
        "starting_mileage" => $faker->randomFloat(2, 1, 100),
        "next_service_mileage" => $faker->randomFloat(2, 1, 100),
        "next_service_date" => $faker->date("Y-m-d", $max = 'now'),
        "service_status" => collect(["Scheduled","Caution","Due","Done",])->random(),
        "availability" => collect(["Yes","No(Road Freight)","N0(Workshop)",])->random(),
        "salvage_value" => $faker->randomNumber(2),
        "investment" => $faker->randomNumber(2),
        "depreciation" => $faker->randomNumber(2),
        "maintenance" => $faker->randomNumber(2),
        "tyre" => $faker->randomNumber(2),
    ];
});
