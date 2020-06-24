<?php

$factory->define(App\ClientVehicle::class, function (Faker\Generator $faker) {
    return [
        "client_id" => factory('App\TimeProject')->create(),
        "registration_number" => $faker->name,
        "vehicle_type" => collect(["Truck","Trailer","Bukkie","Horse","Light","Twin Cab","Single Differential: with dropsides","Double Differential: with dropsides","Double Differential: horse only","Single Differential with semi-trailer","6x4 Truck with timber trailer","6x4 Truck with sugar cane single spiller trailer",])->random(),
        "make" => $faker->name,
        "model" => $faker->name,
        "starting_mileage" => $faker->randomFloat(2, 1, 100),
        "next_service_mileage" => $faker->randomFloat(2, 1, 100),
        "next_service_date" => $faker->date("Y-m-d", $max = 'now'),
        "status" => collect(["Scheduled","Caution","Due","Done",])->random(),
    ];
});
