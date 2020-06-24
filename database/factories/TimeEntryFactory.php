<?php

$factory->define(App\TimeEntry::class, function (Faker\Generator $faker) {
    return [
        "operation_number" => $faker->name,
        "entry_date" => $faker->date("Y-m-d", $max = 'now'),
        "client_id" => factory('App\TimeProject')->create(),
        "start_time" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "end_time" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "status" => collect(["Pending","Open","In Progress","Closed",])->random(),
    ];
});
