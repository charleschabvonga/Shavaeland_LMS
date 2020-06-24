<?php

use Illuminate\Database\Seeder;

class MachinerySizeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'size' => '3.0 ton', 'attachment_id' => 1,],
            ['id' => 2, 'size' => '4.0 ton', 'attachment_id' => 1,],
            ['id' => 3, 'size' => '6.0 ton', 'attachment_id' => 1,],
            ['id' => 4, 'size' => '7.0 ton', 'attachment_id' => 1,],
            ['id' => 5, 'size' => '8.0 ton', 'attachment_id' => 1,],
            ['id' => 6, 'size' => '14.0 ton', 'attachment_id' => 1,],
            ['id' => 7, 'size' => '22.0 ton', 'attachment_id' => 1,],
            ['id' => 8, 'size' => '25.0 ton', 'attachment_id' => 1,],
            ['id' => 17, 'size' => '30.0 ton', 'attachment_id' => 2,],
            ['id' => 18, 'size' => '34.0 ton', 'attachment_id' => 2,],

        ];

        foreach ($items as $item) {
            \App\MachinerySize::create($item);
        }
    }
}
