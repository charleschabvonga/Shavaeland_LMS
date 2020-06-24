<?php

$factory->define(App\Workshop::class, function (Faker\Generator $faker) {
    return [
        "vendor_id" => factory('App\Vendor')->create(),
        "center_name" => $faker->name,
    ];
});
