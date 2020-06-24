<?php

$factory->define(App\TimeProject::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "client_type" => collect(["Client","Department",])->random(),
        "street_address" => $faker->name,
        "city" => $faker->name,
        "province" => $faker->name,
        "postal_code" => $faker->name,
        "country" => $faker->name,
        "vat_number" => $faker->name,
        "website" => $faker->name,
        "email" => $faker->safeEmail,
        "phone_number_1" => $faker->name,
        "phone_number_2" => $faker->name,
        "fax_number" => $faker->name,
    ];
});
