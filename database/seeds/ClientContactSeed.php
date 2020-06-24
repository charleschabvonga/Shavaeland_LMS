<?php

use Illuminate\Database\Seeder;

class ClientContactSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'company_name_id' => 1, 'contact_name' => 'Chaps', 'phone_number' => null, 'email' => 'chaps@zebrafreight.com',],
            ['id' => 2, 'company_name_id' => 2, 'contact_name' => 'Sally', 'phone_number' => '', 'email' => 'sally@wmsl.co.za',],
            ['id' => 3, 'company_name_id' => 3, 'contact_name' => 'Itai', 'phone_number' => '+263779634169', 'email' => '',],

        ];

        foreach ($items as $item) {
            \App\ClientContact::create($item);
        }
    }
}
