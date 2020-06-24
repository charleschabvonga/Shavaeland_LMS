<?php

use Illuminate\Database\Seeder;

class OperationTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Project',],
            ['id' => 2, 'name' => 'Transaction',],

        ];

        foreach ($items as $item) {
            \App\OperationType::create($item);
        }
    }
}
