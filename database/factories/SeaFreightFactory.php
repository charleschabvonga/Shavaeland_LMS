<?php

$factory->define(App\SeaFreight::class, function (Faker\Generator $faker) {
    return [
        "project_number_id" => factory('App\TimeEntry')->create(),
        "sea_freight_number" => $faker->name,
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "shipper_or_agent_contact_id" => factory('App\VendorContact')->create(),
        "project_manager_id" => factory('App\Employee')->create(),
        "voyage_number" => $faker->name,
        "route_id" => factory('App\Route')->create(),
    ];
});
