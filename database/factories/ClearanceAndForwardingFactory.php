<?php

$factory->define(App\ClearanceAndForwarding::class, function (Faker\Generator $faker) {
    return [
        "project_number_id" => factory('App\TimeEntry')->create(),
        "clearance_and_forwarding_number" => $faker->name,
        "border_post" => $faker->name,
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "agent_id" => factory('App\Vendor')->create(),
        "agent_contact_id" => factory('App\VendorContact')->create(),
        "project_manager_id" => factory('App\Employee')->create(),
    ];
});
