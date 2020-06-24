<?php

$factory->define(App\ExpenseCategory::class, function (Faker\Generator $faker) {
    return [
        "transaction_type_id" => factory('App\TimeWorkType')->create(),
        "transaction_number_id" => factory('App\TimeEntry')->create(),
        "entry_date" => $faker->date("Y-m-d", $max = 'now'),
        "due_date" => $faker->date("Y-m-d", $max = 'now'),
        "prepared_by" => $faker->name,
        "credit_note_number" => $faker->name,
        "vendor_id" => factory('App\Vendor')->create(),
        "contact_person_id" => factory('App\VendorContact')->create(),
        "account_manager_id" => factory('App\Employee')->create(),
        "purchase_order_number_id" => factory('App\PurchaseOrder')->create(),
        "vendor_purchase_order_number" => $faker->name,
        "status" => collect(["Draft","Sent","Payment due","Partially paid","Paid","Up to date",])->random(),
        "terms_and_conditions" => $faker->name,
        "subtotal" => $faker->randomNumber(2),
        "percent_discount" => $faker->randomFloat(2, 1, 100),
        "discount_amount" => $faker->randomNumber(2),
        "discounted_subtotal" => $faker->randomNumber(2),
        "vat" => $faker->randomFloat(2, 1, 100),
        "vat_amount" => $faker->randomNumber(2),
        "total_amount" => $faker->randomNumber(2),
        "paid_to_date" => $faker->randomNumber(2),
        "balance" => $faker->randomNumber(2),
    ];
});
