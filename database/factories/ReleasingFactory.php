<?php

$factory->define(App\Releasing::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "project_number_id" => factory('App\TimeEntry')->create(),
        "warehouse_id" => factory('App\Warehouse')->create(),
        "release_number" => $faker->name,
        "prepared_by" => $faker->name,
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "released_by_id" => factory('App\Employee')->create(),
        "project_manager_id" => factory('App\Employee')->create(),
        "area_coverd" => $faker->randomFloat(2, 1, 100),
    ];
});
