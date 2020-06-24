<?php

$factory->define(App\Employee::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "position" => collect(["Director","Non Executive Director","Administrator","Manager","Supervisor","Driver","Technician","General",])->random(),
        "start_date" => $faker->date("Y-m-d", $max = 'now'),
        "end_date" => $faker->date("Y-m-d", $max = 'now'),
        "status" => collect(["Full-time","Part-time","Promoted","Transfered","Resigned","Released","Contract Terminated",])->random(),
        "street_address" => $faker->name,
        "city" => $faker->name,
        "province" => $faker->name,
        "country" => $faker->name,
        "sa_mobile" => $faker->name,
        "int_mobile" => $faker->name,
        "email" => $faker->safeEmail,
    ];
});
