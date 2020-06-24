<?php

$factory->define(App\Payslip::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "starting_date" => $faker->date("Y-m-d", $max = 'now'),
        "ending_date" => $faker->date("Y-m-d", $max = 'now'),
        "employee_id" => factory('App\Employee')->create(),
        "batch_number_id" => factory('App\SalariesRequestTotal')->create(),
        "account_number_id" => factory('App\PayeeAccount')->create(),
        "payslip_number" => $faker->name,
        "status" => collect(["Draft","Payment due","Partially paid","Paid",])->random(),
        "overtime_and_bonus_total" => $faker->randomNumber(2),
        "deductions_total" => $faker->randomNumber(2),
        "gross" => $faker->randomNumber(2),
        "income_tax" => $faker->randomFloat(2, 1, 100),
        "income_tax_amount" => $faker->randomNumber(2),
        "net_income" => $faker->randomNumber(2),
        "paid_to_date" => $faker->randomNumber(2),
        "balance" => $faker->randomNumber(2),
        "prepared_by" => $faker->name,
    ];
});
