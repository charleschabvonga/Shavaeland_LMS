<?php

$factory->define(App\Expense::class, function (Faker\Generator $faker) {
    return [
        "entry_date" => $faker->date("Y-m-d", $max = 'now'),
        "payment_type" => collect(["Purchase credit note pymt","Purchase credit note and debit note pymt","Refund cashback","Refund account credit","Salaries",])->random(),
        "withdrawal_transaction_number_id" => factory('App\VendorBankPayment')->create(),
        "prepared_by" => $faker->name,
        "payment_number" => $faker->name,
        "vendor_credit_note_number_id" => factory('App\ExpenseCategory')->create(),
        "debit_note_number_id" => factory('App\DebitNote')->create(),
        "vendor_id" => factory('App\Vendor')->create(),
        "client_credit_note_number_id" => factory('App\CreditNote')->create(),
        "client_id" => factory('App\TimeProject')->create(),
        "operation_type_id" => factory('App\OperationType')->create(),
        "transaction_type_id" => factory('App\TimeWorkType')->create(),
        "transaction_number_id" => factory('App\TimeEntry')->create(),
        "expense_category" => $faker->name,
        "amount" => $faker->randomNumber(2),
    ];
});
