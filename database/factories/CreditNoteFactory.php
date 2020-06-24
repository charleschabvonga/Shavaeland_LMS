<?php

$factory->define(App\CreditNote::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "refund_type" => collect(["Advance pymt refund","Sales refund cashback","Sales refund account credit",])->random(),
        "invoice_payment_number_id" => factory('App\Income')->create(),
        "project_number_id" => factory('App\TimeEntry')->create(),
        "invoice_number_id" => factory('App\IncomeCategory')->create(),
        "bank_reference_id" => factory('App\BankPayment')->create(),
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "account_manager_id" => factory('App\Employee')->create(),
        "prepared_by" => $faker->name,
        "credit_note_number" => $faker->name,
        "status" => collect(["Draft","Sent","Payment due","Partially paid","Paid","Account credited","Rejected",])->random(),
        "terms_and_conditions" => $faker->name,
        "subtotal" => $faker->randomNumber(2),
        "vat" => $faker->randomFloat(2, 1, 100),
        "vat_amount" => $faker->randomNumber(2),
        "total_amount" => $faker->randomNumber(2),
        "paid_to_date" => $faker->randomNumber(2),
        "balance" => $faker->randomNumber(2),
    ];
});
