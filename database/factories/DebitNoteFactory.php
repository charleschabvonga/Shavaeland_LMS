<?php

$factory->define(App\DebitNote::class, function (Faker\Generator $faker) {
    return [
        "refund_type" => collect(["Advance payment refund","Purchase return refund","Product exchange","Service redo",])->random(),
        "vendor_id" => factory('App\Vendor')->create(),
        "contact_person_id" => factory('App\VendorContact')->create(),
        "account_manager_id" => factory('App\Employee')->create(),
        "transaction_number_id" => factory('App\TimeEntry')->create(),
        "credit_note_number_id" => factory('App\ExpenseCategory')->create(),
        "withdrawal_transaction_number_id" => factory('App\VendorBankPayment')->create(),
        "credit_note_payment_number_id" => factory('App\Expense')->create(),
        "debit_note_number" => $faker->name,
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "payment_status" => collect(["Unpaid","Paid","Partially paid","Rejected",])->random(),
        "subtotal" => $faker->randomNumber(2),
        "vat" => $faker->randomFloat(2, 1, 100),
        "vat_amount" => $faker->randomNumber(2),
        "total_amount" => $faker->randomNumber(2),
        "paid_to_date" => $faker->randomNumber(2),
        "balance" => $faker->randomNumber(2),
        "prepared_by" => $faker->name,
    ];
});
