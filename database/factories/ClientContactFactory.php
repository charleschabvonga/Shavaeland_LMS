<?php

$factory->define(App\ClientContact::class, function (Faker\Generator $faker) {
    return [
        "company_name_id" => factory('App\TimeProject')->create(),
        "contact_name" => $faker->name,
        "phone_number" => $faker->name,
        "email" => $faker->name,
    ];
});
