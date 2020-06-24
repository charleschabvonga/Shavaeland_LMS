<?php

$factory->define(App\BankPayment::class, function (Faker\Generator $faker) {
    return [
        "entry_date" => $faker->date("Y-m-d", $max = 'now'),
        "depositor" => collect(["Client","Vendor advance pymt refund","Vendor purchase refund",])->random(),
        "payment_mode" => collect(["Bank Transfer","Cash","Cheque",])->random(),
        "prepared_by" => $faker->name,
        "payment_number" => $faker->name,
        "client_id" => factory('App\TimeProject')->create(),
        "account_number_id" => factory('App\ClientAccount')->create(),
        "vendor_id" => factory('App\Vendor')->create(),
        "vendor_account_number_id" => factory('App\VendorAccount')->create(),
        "debit_note_number_id" => factory('App\DebitNote')->create(),
        "amount" => $faker->randomNumber(2),
        "balance" => $faker->randomNumber(2),
    ];
});
