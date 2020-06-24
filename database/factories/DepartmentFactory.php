<?php

$factory->define(App\Department::class, function (Faker\Generator $faker) {
    return [
        "dept_name" => $faker->name,
        "manager" => $faker->name,
        "street_address" => $faker->name,
        "city" => $faker->name,
        "province" => $faker->name,
        "country" => $faker->name,
        "phone_no" => $faker->name,
        "extension" => $faker->name,
        "mobile_number" => $faker->name,
        "email" => $faker->safeEmail,
    ];
});
