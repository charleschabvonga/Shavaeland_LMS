<?php

$factory->define(App\ClientJobCard::class, function (Faker\Generator $faker) {
    return [
        "job_request_number_id" => factory('App\JobRequest')->create(),
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "job_card_number" => $faker->name,
        "prepared_by" => $faker->name,
        "project_number_id" => factory('App\TimeEntry')->create(),
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "status" => collect(["Job Ongoing","Job Complete",])->random(),
        "job_type" => collect(["Scheduled","Breakdown",])->random(),
        "repair_center_id" => factory('App\Workshop')->create(),
        "client_vehicle_reg_no_id" => factory('App\JobRequest')->create(),
        "remarks" => $faker->name,
        "instructions" => $faker->name,
        "subtotal" => $faker->randomNumber(2),
    ];
});
