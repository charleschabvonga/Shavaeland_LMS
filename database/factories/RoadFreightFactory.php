<?php

$factory->define(App\RoadFreight::class, function (Faker\Generator $faker) {
    return [
        "project_number_id" => factory('App\TimeEntry')->create(),
        "road_freight_number" => $faker->name,
        "freight_contract_type" => collect(["Shavaeland","Subcontractor",])->random(),
        "route_id" => factory('App\Route')->create(),
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "project_manager_id" => factory('App\Employee')->create(),
        "driver_id" => factory('App\Employee')->create(),
        "vehicle_id" => factory('App\Vehicle')->create(),
        "subcontractor_number_id" => factory('App\RoadFreightSubContractor')->create(),
        "vendor_id" => factory('App\Vendor')->create(),
        "vendor_contact_person_id" => factory('App\VendorContact')->create(),
        "road_freight_income" => $faker->randomNumber(2),
        "road_freight_expenses" => $faker->randomNumber(2),
        "machinery_costs" => $faker->randomNumber(2),
        "breakdown" => $faker->randomNumber(2),
        "total_expenses" => $faker->randomNumber(2),
        "net_income" => $faker->randomNumber(2),
    ];
});
