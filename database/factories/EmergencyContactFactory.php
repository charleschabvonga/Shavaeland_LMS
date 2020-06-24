<?php

$factory->define(App\EmergencyContact::class, function (Faker\Generator $faker) {
    return [
        "employee_name_id" => factory('App\Employee')->create(),
        "name" => $faker->name,
        "phone1" => $faker->name,
        "phone" => $faker->name,
    ];
});
