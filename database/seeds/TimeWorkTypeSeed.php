<?php

use Illuminate\Database\Seeder;

class TimeWorkTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Road Freight',],
            ['id' => 2, 'name' => 'Warehouse',],
            ['id' => 3, 'name' => 'Clearing & Forwarding',],
            ['id' => 4, 'name' => 'Air Freight',],
            ['id' => 5, 'name' => 'Rail Freight',],
            ['id' => 6, 'name' => 'Sea Freight',],
            ['id' => 7, 'name' => 'Workshop',],
            ['id' => 9, 'name' => 'Human Resources',],
            ['id' => 10, 'name' => 'Amenities',],
            ['id' => 11, 'name' => 'Payments',],

        ];

        foreach ($items as $item) {
            \App\TimeWorkType::create($item);
        }
    }
}
