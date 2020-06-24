<?php

$factory->define(App\Vendor::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "vendor_type" => collect(["","Supplier","Department",])->random(),
        "street_address" => $faker->name,
        "city" => $faker->name,
        "province" => $faker->name,
        "postal_code" => $faker->name,
        "country" => $faker->name,
        "vat" => $faker->name,
        "website" => $faker->name,
        "email" => $faker->safeEmail,
        "phone_number_1" => $faker->name,
        "phone_number_2" => $faker->name,
        "fax_number" => $faker->name,
        "tax_clearance_number" => $faker->name,
        "tax_clearance_expiration_date" => $faker->date("Y-m-d", $max = 'now'),
        "company_registration_number" => $faker->name,
        "directors_name" => $faker->name,
        "director_id_number" => $faker->name,
    ];
});
