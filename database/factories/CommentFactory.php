<?php

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->name,
        "comments" => $faker->name,
    ];
});
