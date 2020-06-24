<?php

$factory->define(App\PartsAcquired::class, function (Faker\Generator $faker) {
    return [
        "order_number" => $faker->name,
        "prepared_by" => $faker->name,
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "transaction_type" => collect(["Procurement","Request",])->random(),
        "repair_center_id" => factory('App\Workshop')->create(),
        "received_by_id" => factory('App\Employee')->create(),
        "dispatched_by_id" => factory('App\Employee')->create(),
        "part_id" => factory('App\Part')->create(),
        "qty" => $faker->randomFloat(2, 1, 100),
        "unit_price" => $faker->randomNumber(2),
        "total" => $faker->randomNumber(2),
    ];
});
