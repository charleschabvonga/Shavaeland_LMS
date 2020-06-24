<?php

$factory->define(App\Qualification::class, function (Faker\Generator $faker) {
    return [
        "employee_name_id" => factory('App\Employee')->create(),
        "institution" => $faker->name,
        "description" => $faker->name,
        "date_obtained" => $faker->date("Y-m-d", $max = 'now'),
        "expiry_date" => $faker->date("Y-m-d", $max = 'now'),
    ];
});
