<?php

$factory->define(App\Violation::class, function (Faker\Generator $faker) {
    return [
        "employee_name_id" => factory('App\Employee')->create(),
        "vehicle_description_id" => factory('App\Vehicle')->create(),
        "trailer_id" => factory('App\Trailer')->create(),
        "road_freight_number_id" => factory('App\RoadFreight')->create(),
        "citation_number" => $faker->name,
        "citation_date" => $faker->date("Y-m-d", $max = 'now'),
        "description" => $faker->name,
        "status" => collect(["Driver","Operations","Workshop",])->random(),
        "amount" => $faker->randomNumber(2),
    ];
});
