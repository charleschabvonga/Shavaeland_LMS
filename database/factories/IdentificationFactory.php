<?php

$factory->define(App\Identification::class, function (Faker\Generator $faker) {
    return [
        "employee_name_id" => factory('App\Employee')->create(),
        "id_type" => $faker->name,
        "id_number" => $faker->name,
        "date_of_birth" => $faker->date("Y-m-d", $max = 'now'),
        "date_obtained" => $faker->date("Y-m-d", $max = 'now'),
        "expiry_date" => $faker->name,
    ];
});
