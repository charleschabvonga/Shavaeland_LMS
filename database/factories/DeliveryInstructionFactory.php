<?php

$factory->define(App\DeliveryInstruction::class, function (Faker\Generator $faker) {
    return [
        "road_freight_number_id" => factory('App\RoadFreight')->create(),
        "freight_contract_type" => collect(["Shavaeland","Subcontractor",])->random(),
        "delivery_instruction_number" => $faker->name,
        "driver_id" => factory('App\Employee')->create(),
        "vehicle_id" => factory('App\Vehicle')->create(),
        "vendor_id" => factory('App\Vendor')->create(),
        "vendor_driver_id" => factory('App\Driver')->create(),
        "order_number" => $faker->name,
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "project_manager_id" => factory('App\Employee')->create(),
        "delivery_company_name" => $faker->name,
        "delivery_date_time" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "prepared_by" => $faker->name,
        "status" => collect(["Draft","Loaded","Delivered",])->random(),
    ];
});
