<?php

$factory->define(App\JobCardItem::class, function (Faker\Generator $faker) {
    return [
        "job_card_items_id" => factory('App\InhouseJobCard')->create(),
        "client_job_card_number_id" => factory('App\ClientJobCard')->create(),
        "workshop" => $faker->name,
        "part" => $faker->name,
        "price" => $faker->randomFloat(2, 1, 100),
        "qty" => $faker->randomFloat(2, 1, 100),
        "unit" => $faker->name,
        "total" => $faker->randomFloat(2, 1, 100),
    ];
});
