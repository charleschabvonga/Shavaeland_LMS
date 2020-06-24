<?php

$factory->define(App\VendorAccount::class, function (Faker\Generator $faker) {
    return [
        "vendor_id" => factory('App\Vendor')->create(),
        "contact_person_id" => factory('App\VendorContact')->create(),
        "account_manager_id" => factory('App\Employee')->create(),
        "account_number" => $faker->name,
        "status" => collect(["Not active","Payment due","Up to date","Paid off","Credit available","Refund pymt due","Closed",])->random(),
    ];
});
