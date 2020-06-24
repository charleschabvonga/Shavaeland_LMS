<?php

use Illuminate\Database\Seeder;

class TimeProjectSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Zebra Freight', 'client_type' => 'Client', 'street_address' => '2 Dann Road, Glen Marius', 'city' => 'Kempton Park 	', 'province' => 'Gauteng', 'postal_code' => null, 'country' => 'South Africa ', 'vat_number' => '4300259134', 'website' => null, 'email' => null, 'phone_number_1' => '+27 11 070 8007', 'phone_number_2' => null, 'fax_number' => '+27 86 607 4008',],
            ['id' => 2, 'name' => 'WMSL', 'client_type' => 'Client', 'street_address' => '9 Clare Street,Kenmare', 'city' => 'Krugersdorp', 'province' => 'Gauteng', 'postal_code' => '1739', 'country' => 'South Africa', 'vat_number' => null, 'website' => null, 'email' => null, 'phone_number_1' => '+27 11 664 6487', 'phone_number_2' => null, 'fax_number' => null,],
            ['id' => 3, 'name' => 'Desleg', 'client_type' => 'Client', 'street_address' => null, 'city' => 'Harare', 'province' => 'Harare Metropolitan', 'postal_code' => null, 'country' => 'Zimbabwe', 'vat_number' => null, 'website' => null, 'email' => null, 'phone_number_1' => '+263779634169', 'phone_number_2' => null, 'fax_number' => null,],

        ];

        foreach ($items as $item) {
            \App\TimeProject::create($item);
        }
    }
}
