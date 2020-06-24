<?php

$factory->define(App\VehicleSc::class, function (Faker\Generator $faker) {
    return [
        "vendor_id" => factory('App\Vendor')->create(),
        "subcontractor_number_id" => factory('App\RoadFreightSubContractor')->create(),
        "vehicle_type" => collect(["Truck","Trailer","Bukkie","Horse","Light","Twin Cab",])->random(),
        "make" => $faker->name,
        "model" => $faker->name,
        "registration_number" => $faker->name,
        "certificate_of_fitness_number" => $faker->name,
        "tracker_pin_details" => $faker->name,
        "tracker_password" => str_random(10),
        "expiration_date" => $faker->date("Y-m-d", $max = 'now'),
        "status" => collect(["Up to date","COF expired",])->random(),
    ];
});
