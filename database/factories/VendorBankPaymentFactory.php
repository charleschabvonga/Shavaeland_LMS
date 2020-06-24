<?php

$factory->define(App\VendorBankPayment::class, function (Faker\Generator $faker) {
    return [
        "entry_date" => $faker->date("Y-m-d", $max = 'now'),
        "withdrawer" => collect(["Vendor","Client advance pymt refund","Client sale refund","Department",])->random(),
        "payment_mode" => collect(["Bank Transfer","Cash","Cheque",])->random(),
        "prepared_by" => $faker->name,
        "payment_number" => $faker->name,
        "vendor_id" => factory('App\Vendor')->create(),
        "account_number_id" => factory('App\VendorAccount')->create(),
        "client_id" => factory('App\TimeProject')->create(),
        "client_account_number_id" => factory('App\ClientAccount')->create(),
        "credit_note_number_id" => factory('App\CreditNote')->create(),
        "amount" => $faker->randomNumber(2),
        "balance" => $faker->randomNumber(2),
    ];
});
