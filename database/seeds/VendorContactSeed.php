<?php

use Illuminate\Database\Seeder;

class VendorContactSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'company_name_id' => 1, 'contact_name' => 'Dudzai Chaka', 'phone_number' => '', 'email' => 'dudzai@bonologistics.com',],
            ['id' => 2, 'company_name_id' => 2, 'contact_name' => 'Tafadzwa Nyagumbo', 'phone_number' => '+27 84 270 6635', 'email' => 'tafadzwa@shavaeland.co.za',],

        ];

        foreach ($items as $item) {
            \App\VendorContact::create($item);
        }
    }
}
