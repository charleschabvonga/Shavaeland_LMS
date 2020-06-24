<?php

$factory->define(App\PayeeAccount::class, function (Faker\Generator $faker) {
    return [
        "employee_id" => factory('App\Employee')->create(),
        "bank" => $faker->name,
        "account_number" => $faker->name,
        "branch_code" => $faker->name,
        "branch" => $faker->name,
        "department_id" => factory('App\Department')->create(),
        "position_id" => factory('App\Employee')->create(),
        "status" => collect(["Not active","Payment due","Up to date","Paid off","Debited","Closed",])->random(),
        "pymt_measurement_type" => collect(["Monthy","BiWeekly","Weekly","Daily","Hrs","kms",])->random(),
        "wage_rate" => $faker->randomNumber(2),
        "pension_rate" => $faker->randomNumber(2),
        "overtime_rate" => $faker->randomNumber(2),
        "public_holiday_rate" => $faker->randomNumber(2),
        "medical_aid" => $faker->randomNumber(2),
        "sales_rate" => $faker->randomFloat(2, 1, 100),
    ];
});
