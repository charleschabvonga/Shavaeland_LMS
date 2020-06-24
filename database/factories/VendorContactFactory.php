<?php

$factory->define(App\VendorContact::class, function (Faker\Generator $faker) {
    return [
        "company_name_id" => factory('App\Vendor')->create(),
        "contact_name" => $faker->name,
        "phone_number" => $faker->name,
        "email" => $faker->name,
    ];
});
