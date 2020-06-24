<?php

$factory->define(App\Income::class, function (Faker\Generator $faker) {
    return [
        "entry_date" => $faker->date("Y-m-d", $max = 'now'),
        "payment_type" => collect(["Invoice pymt","Invoice and credit note pymt","Refund account credit","Refund cashback",])->random(),
        "deposit_transaction_number_id" => factory('App\BankPayment')->create(),
        "prepared_by" => $faker->name,
        "payment_number" => $faker->name,
        "invoice_number_id" => factory('App\IncomeCategory')->create(),
        "sales_credit_note_number_id" => factory('App\CreditNote')->create(),
        "client_id" => factory('App\TimeProject')->create(),
        "debit_note_number_id" => factory('App\DebitNote')->create(),
        "vendor_id" => factory('App\Vendor')->create(),
        "operation_type_id" => factory('App\OperationType')->create(),
        "project_type_id" => factory('App\TimeWorkType')->create(),
        "project_number_id" => factory('App\TimeEntry')->create(),
        "income_category" => $faker->name,
        "amount" => $faker->randomNumber(2),
    ];
});
