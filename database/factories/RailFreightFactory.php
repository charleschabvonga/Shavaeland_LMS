<?php

$factory->define(App\RailFreight::class, function (Faker\Generator $faker) {
    return [
        "project_number_id" => factory('App\TimeEntry')->create(),
        "rail_freight_number" => $faker->name,
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "railline_or_agent_contact_id" => factory('App\VendorContact')->create(),
        "project_manager_id" => factory('App\Employee')->create(),
        "trip_number" => $faker->name,
        "route_id" => factory('App\Route')->create(),
    ];
});
