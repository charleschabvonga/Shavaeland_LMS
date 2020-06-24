<?php

$factory->define(App\InhouseJobCard::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "vehicle_type" => collect(["Horse","Truck","Trailer","Bukkie","Light","Twin Cab",])->random(),
        "mileage" => $faker->name,
        "job_card_number" => $faker->name,
        "prepared_by" => $faker->name,
        "project_number_id" => factory('App\TimeEntry')->create(),
        "client_type" => collect(["Client type",])->random(),
        "job_card_type" => collect(["Project","Inhouse",])->random(),
        "job_type" => collect(["Scheduled","Breakdown",])->random(),
        "repair_center_id" => factory('App\Workshop')->create(),
        "vehicle_id" => factory('App\Vehicle')->create(),
        "trailer_id" => factory('App\Trailer')->create(),
        "light_vehicles_id" => factory('App\LightVehicle')->create(),
        "client_vehicle_reg_no_id" => factory('App\VehicleSc')->create(),
        "road_freight_number_id" => factory('App\RoadFreight')->create(),
        "remarks" => $faker->name,
        "instructions" => $faker->name,
        "subtotal" => $faker->randomNumber(2),
    ];
});
