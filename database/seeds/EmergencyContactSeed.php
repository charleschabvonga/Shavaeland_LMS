<?php

use Illuminate\Database\Seeder;

class EmergencyContactSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'employee_name_id' => 5, 'name' => 'Orripa Kativhu', 'phone1' => '+263 776369944', 'phone' => '',],
            ['id' => 2, 'employee_name_id' => 9, 'name' => 'Beauty Manuel', 'phone1' => '+263779335494', 'phone' => '',],

        ];

        foreach ($items as $item) {
            \App\EmergencyContact::create($item);
        }
    }
}
