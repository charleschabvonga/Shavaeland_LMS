<?php

$factory->define(App\ScheduleOfService::class, function (Faker\Generator $faker) {
    return [
        "client_type" => collect(["Customer","Department",])->random(),
        "client_id" => factory('App\TimeProject')->create(),
        "job_card_number_id" => factory('App\InhouseJobCard')->create(),
        "vehicle_id" => factory('App\Vehicle')->create(),
        "client_vehicle_id" => factory('App\ClientVehicle')->create(),
        "description" => $faker->name,
        "next_service_mileage" => $faker->randomFloat(2, 1, 100),
        "next_service_date" => $faker->date("Y-m-d", $max = 'now'),
        "status" => collect(["Scheduled","Caution","Due","Done",])->random(),
        "schedule_number" => $faker->name,
    ];
});
