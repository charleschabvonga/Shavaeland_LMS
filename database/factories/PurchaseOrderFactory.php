<?php

$factory->define(App\PurchaseOrder::class, function (Faker\Generator $faker) {
    return [
        "vendor_id" => factory('App\Vendor')->create(),
        "contact_person_id" => factory('App\VendorContact')->create(),
        "buyer_id" => factory('App\Employee')->create(),
        "purchase_order_number" => $faker->name,
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "request_date" => $faker->date("Y-m-d", $max = 'now'),
        "procurement_date" => $faker->date("Y-m-d", $max = 'now'),
        "subtotal" => $faker->randomNumber(2),
        "status" => collect(["Requested","Confirmed","Approved","Purchased",])->random(),
        "vat" => $faker->randomFloat(2, 1, 100),
        "vat_amount" => $faker->randomNumber(2),
        "total_amount" => $faker->randomNumber(2),
        "prepared_by" => $faker->name,
        "requested_by" => $faker->name,
        "hod" => 0,
        "gm" => 0,
        "accounts" => 0,
    ];
});
