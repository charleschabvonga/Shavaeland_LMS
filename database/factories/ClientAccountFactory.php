<?php

$factory->define(App\ClientAccount::class, function (Faker\Generator $faker) {
    return [
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "account_manager_id" => factory('App\Employee')->create(),
        "account_number" => $faker->name,
        "status" => collect(["Not active","Payment due","Up to date","Paid off","Credit available","Refund pymt due","Closed",])->random(),
    ];
});
