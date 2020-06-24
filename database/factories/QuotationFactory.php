<?php

$factory->define(App\Quotation::class, function (Faker\Generator $faker) {
    return [
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "sales_person_id" => factory('App\Employee')->create(),
        "quotation_number" => $faker->name,
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "due_date" => $faker->date("Y-m-d", $max = 'now'),
        "status" => collect(["Draft","Sent","Confirmed","Unconfirmed","Invoiced","Expired",])->random(),
        "subtotal" => $faker->randomNumber(2),
        "vat" => $faker->randomFloat(2, 1, 100),
        "vat_amount" => $faker->randomNumber(2),
        "total_amount" => $faker->randomNumber(2),
        "prepared_by" => $faker->name,
    ];
});
