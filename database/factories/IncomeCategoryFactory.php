<?php

$factory->define(App\IncomeCategory::class, function (Faker\Generator $faker) {
    return [
        "project_type_id" => factory('App\TimeWorkType')->create(),
        "project_number_id" => factory('App\TimeEntry')->create(),
        "entry_date" => $faker->date("Y-m-d", $max = 'now'),
        "due_date" => $faker->date("Y-m-d", $max = 'now'),
        "prepared_by" => $faker->name,
        "invoice_number" => $faker->name,
        "client_id" => factory('App\TimeProject')->create(),
        "contact_person_id" => factory('App\ClientContact')->create(),
        "account_manager_id" => factory('App\Employee')->create(),
        "quotation_number_id" => factory('App\Quotation')->create(),
        "sales_order_number" => $faker->name,
        "status" => collect(["Draft","Sent","Payment due","Partially paid","Paid","Up to date",])->random(),
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
