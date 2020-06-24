<?php

$factory->define(App\TruckAttachmentStatus::class, function (Faker\Generator $faker) {
    return [
        "attachment" => $faker->name,
    ];
});
