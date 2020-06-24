<?php

$factory->define(App\Receiving::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "project_number_id" => factory('App\TimeEntry')->create(),
        "warehouse_id" => factory('App\Warehouse')->create(),
        "receipt_number" => $faker->name,
        "prepared_by" => $faker->name,
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "received_by_id" => factory('App\Employee')->create(),
        "project_manager_id" => factory('App\Employee')->create(),
        "rate" => $faker->randomFloat(2, 1, 100),
        "days" => $faker->randomFloat(2, 1, 100),
        "total_area_coverd" => $faker->randomFloat(2, 1, 100),
        "total_amount" => $faker->randomFloat(2, 1, 100),
    ];
});
