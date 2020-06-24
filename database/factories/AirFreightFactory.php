<?php

$factory->define(App\AirFreight::class, function (Faker\Generator $faker) {
    return [
        "project_number_id" => factory('App\TimeEntry')->create(),
        "air_freight_number" => $faker->name,
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "airline_or_agent_contact_id" => factory('App\VendorContact')->create(),
        "project_manager_id" => factory('App\Employee')->create(),
        "flight_number" => $faker->name,
        "route_id" => factory('App\Route')->create(),
    ];
});
