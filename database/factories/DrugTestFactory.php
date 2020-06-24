<?php

$factory->define(App\DrugTest::class, function (Faker\Generator $faker) {
    return [
        "drug_test_number" => $faker->name,
        "employee_name_id" => factory('App\Employee')->create(),
        "last_annual_drug_test" => $faker->date("Y-m-d", $max = 'now'),
        "last_random_drug_test" => $faker->name,
        "last_physical_exam_date" => $faker->date("Y-m-d", $max = 'now'),
        "description" => $faker->name,
    ];
});
