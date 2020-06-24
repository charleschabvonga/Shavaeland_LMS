<?php

use Illuminate\Database\Seeder;

class MachineryTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 3, 'machinery_type' => 'Flatbed tri axle', 'attachment_id' => 2,],
            ['id' => 4, 'machinery_type' => 'Flatbed front link', 'attachment_id' => 2,],
            ['id' => 5, 'machinery_type' => 'Flatbed back link', 'attachment_id' => 2,],
            ['id' => 6, 'machinery_type' => 'Flatbed tri axle with sideboards', 'attachment_id' => 2,],
            ['id' => 7, 'machinery_type' => 'Flatbed front link with sideboards', 'attachment_id' => 2,],
            ['id' => 8, 'machinery_type' => 'Flatbed back link with sideboards', 'attachment_id' => 2,],
            ['id' => 9, 'machinery_type' => 'Flatbed tri axle tipper', 'attachment_id' => 2,],
            ['id' => 10, 'machinery_type' => 'Flatbed front link tipper', 'attachment_id' => 2,],
            ['id' => 11, 'machinery_type' => 'Flatbed back link tipper', 'attachment_id' => 2,],
            ['id' => 12, 'machinery_type' => 'Flatbed tri axle tanker', 'attachment_id' => 2,],
            ['id' => 13, 'machinery_type' => 'Flatbed front link tanker', 'attachment_id' => 2,],
            ['id' => 14, 'machinery_type' => 'Flatbed back link tanker', 'attachment_id' => 2,],
            ['id' => 15, 'machinery_type' => 'Flatbed tri axle with curtain sides', 'attachment_id' => 2,],
            ['id' => 16, 'machinery_type' => 'Flatbed front link with curtain sides', 'attachment_id' => 2,],
            ['id' => 17, 'machinery_type' => 'Flatbed back link with curtain sides', 'attachment_id' => 2,],
            ['id' => 18, 'machinery_type' => 'Rigit with curtain sides', 'attachment_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\MachineryType::create($item);
        }
    }
}
