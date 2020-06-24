<?php

$factory->define(App\OvertimeAndBonusItem::class, function (Faker\Generator $faker) {
    return [
        "item_number_id" => factory('App\Payslip')->create(),
        "item_description" => $faker->name,
        "unit_price" => $faker->randomNumber(2),
        "qty" => $faker->randomFloat(2, 1, 100),
        "total" => $faker->randomNumber(2),
        "unit" => $faker->name,
    ];
});
