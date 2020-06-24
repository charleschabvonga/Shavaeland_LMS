<?php

$factory->define(App\InvoiceItem::class, function (Faker\Generator $faker) {
    return [
        "invoice_number_id" => factory('App\IncomeCategory')->create(),
        "bill_number_id" => factory('App\ExpenseCategory')->create(),
        "credit_note_number_id" => factory('App\CreditNote')->create(),
        "debit_note_number_id" => factory('App\DebitNote')->create(),
        "clearance_and_forwarding_number_id" => factory('App\ClearanceAndForwarding')->create(),
        "quotation_number_id" => factory('App\Quotation')->create(),
        "item_description" => $faker->name,
        "unit_price" => $faker->randomNumber(2),
        "qty" => $faker->randomFloat(2, 1, 100),
        "total" => $faker->randomNumber(2),
    ];
});
