<?php

$factory->define(App\RoadFreightSubContractor::class, function (Faker\Generator $faker) {
    return [
        "subcontractor_number" => $faker->name,
        "vendor_id" => factory('App\Vendor')->create(),
        "git_cover_number" => $faker->name,
        "status" => collect(["Under process","Approved","Declined",])->random(),
        "git_expiry_date" => $faker->date("Y-m-d", $max = 'now'),
        "git_status" => collect(["Up to date","GIT expired",])->random(),
    ];
});
