<?php

$factory->define(App\MachinerySize::class, function (Faker\Generator $faker) {
    return [
        "size" => $faker->name,
        "attachment_id" => factory('App\TruckAttachmentStatus')->create(),
    ];
});
