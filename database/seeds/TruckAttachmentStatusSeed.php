<?php

use Illuminate\Database\Seeder;

class TruckAttachmentStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'attachment' => 'Trucks without trailers',],
            ['id' => 2, 'attachment' => 'Trucks with trailers',],

        ];

        foreach ($items as $item) {
            \App\TruckAttachmentStatus::create($item);
        }
    }
}
