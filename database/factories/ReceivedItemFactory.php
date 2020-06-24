<?php

$factory->define(App\ReceivedItem::class, function (Faker\Generator $faker) {
    return [
        "receipt_number_id" => factory('App\Receiving')->create(),
        "release_number_id" => factory('App\Releasing')->create(),
        "item" => $faker->name,
        "qty" => $faker->randomFloat(2, 1, 100),
        "area" => $faker->randomFloat(2, 1, 100),
        "unit" => $faker->name,
    ];
});
