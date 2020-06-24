<?php

$factory->define(App\JobRequest::class, function (Faker\Generator $faker) {
    return [
        "project_number_id" => factory('App\TimeEntry')->create(),
        "description" => $faker->name,
        "workshop_manager_id" => factory('App\Employee')->create(),
        "job_request_number" => $faker->name,
        "requested_by" => $faker->name,
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "vehicle_type" => collect(["Horse","Truck","Trailer","Bukkie","Light","Twin Cab",])->random(),
        "vehicle_registration_number" => $faker->name,
        "make" => $faker->name,
        "model" => $faker->name,
        "mileage" => $faker->name,
        "next_service_mileage" => $faker->randomFloat(2, 1, 100),
        "next_service_date" => $faker->date("Y-m-d", $max = 'now'),
        "status" => collect(["Open","Closed",])->random(),
    ];
});
