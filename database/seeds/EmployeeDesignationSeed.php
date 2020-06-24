<?php

use Illuminate\Database\Seeder;

class EmployeeDesignationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'position' => 'Director',],
            ['id' => 2, 'position' => 'Non Executive Director',],
            ['id' => 3, 'position' => 'Administrator',],
            ['id' => 4, 'position' => 'Manager',],
            ['id' => 5, 'position' => 'Supervisor',],
            ['id' => 6, 'position' => 'Driver',],
            ['id' => 7, 'position' => 'Technician',],

        ];

        foreach ($items as $item) {
            \App\EmployeeDesignation::create($item);
        }
    }
}
