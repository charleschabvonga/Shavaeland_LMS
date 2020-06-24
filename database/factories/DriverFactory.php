<?php

$factory->define(App\Driver::class, function (Faker\Generator $faker) {
    return [
        "vendor_id" => factory('App\Vendor')->create(),
        "subcontractor_number_id" => factory('App\RoadFreightSubContractor')->create(),
        "name" => $faker->name,
        "date_of_birth" => $faker->date("Y-m-d", $max = 'now'),
        "drivers_license_number" => $faker->name,
        "drivers_license_expiry_date" => $faker->date("Y-m-d", $max = 'now'),
        "int_drivers_license_no" => $faker->name,
        "int_drivers_license_expiry_date" => $faker->date("Y-m-d", $max = 'now'),
        "drivers_passport_number" => $faker->name,
        "passport_expiry_date" => $faker->date("Y-m-d", $max = 'now'),
        "sa_phone_number" => $faker->name,
        "int_phone_number" => $faker->name,
        "police_clearance_expiry_date" => $faker->date("Y-m-d", $max = 'now'),
        "retest_number" => $faker->name,
        "retest_expiry_date" => $faker->date("Y-m-d", $max = 'now'),
    ];
});
