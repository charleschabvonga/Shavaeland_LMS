<?php

$factory->define(App\MachineryType::class, function (Faker\Generator $faker) {
    return [
        "machinery_type" => $faker->name,
        "attachment_id" => factory('App\TruckAttachmentStatus')->create(),
    ];
});
