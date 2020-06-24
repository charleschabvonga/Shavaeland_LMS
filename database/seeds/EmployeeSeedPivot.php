<?php

use Illuminate\Database\Seeder;

class EmployeeSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            1 => [
                'department' => [2, 3],
            ],
            2 => [
                'department' => [1],
            ],
            3 => [
                'department' => [4],
            ],
            4 => [
                'department' => [2],
            ],
            5 => [
                'department' => [2],
            ],
            9 => [
                'department' => [2],
            ],

        ];

        foreach ($items as $id => $item) {
            $employee = \App\Employee::find($id);

            foreach ($item as $key => $ids) {
                $employee->{$key}()->sync($ids);
            }
        }
    }
}
