<?php

$factory->define(App\SalariesRequestTotal::class, function (Faker\Generator $faker) {
    return [
        "batch_number" => $faker->name,
        "starting_pay_date" => $faker->date("Y-m-d", $max = 'now'),
        "ending_pay_date" => $faker->date("Y-m-d", $max = 'now'),
        "status" => collect(["In progress","Partially paid","Paid","Payment due",])->random(),
    ];
});
