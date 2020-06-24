<?php

$factory->define(App\LoadingRequirement::class, function (Faker\Generator $faker) {
    return [
        "loading_instruction_number_id" => factory('App\LoadingInstruction')->create(),
        "item_description" => $faker->name,
        "qty" => $faker->randomFloat(2, 1, 100),
        "unit" => $faker->name,
    ];
});
