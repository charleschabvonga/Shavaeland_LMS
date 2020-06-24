<?php

$factory->define(App\PayeePayment::class, function (Faker\Generator $faker) {
    return [
        "entry_date" => $faker->date("Y-m-d", $max = 'now'),
        "employee_id" => factory('App\Employee')->create(),
        "payslip_number_id" => factory('App\Payslip')->create(),
        "batch_number_id" => factory('App\SalariesRequestTotal')->create(),
        "withdrawal_transaction_number_id" => factory('App\VendorBankPayment')->create(),
        "payee_account_number_id" => factory('App\PayeeAccount')->create(),
        "payee_payment_number" => $faker->name,
        "payment_mode" => collect(["Bank Transfer","Cash","Cheque",])->random(),
        "amount" => $faker->randomNumber(2),
        "prepared_by" => $faker->name,
    ];
});
