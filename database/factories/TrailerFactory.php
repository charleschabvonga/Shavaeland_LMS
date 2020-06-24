<?php

$factory->define(App\Trailer::class, function (Faker\Generator $faker) {
    return [
        "trailer_type_id" => factory('App\MachineryType')->create(),
        "trailer_description" => $faker->name,
        "make" => $faker->name,
        "model" => $faker->name,
        "availability" => collect(["Yes","No(Road Freight)","N0(Workshop)",])->random(),
        "service_status" => collect(["Scheduled","Caution","Due","Done",])->random(),
        "chasis_number" => $faker->name,
        "purchase_date" => $faker->date("Y-m-d", $max = 'now'),
        "purchase_price" => $faker->randomNumber(2),
        "salvage_value" => $faker->randomNumber(2),
        "investment" => $faker->randomNumber(2),
        "depreciation" => $faker->randomNumber(2),
        "maintenance" => $faker->randomNumber(2),
        "tyre" => $faker->randomNumber(2),
    ];
});
