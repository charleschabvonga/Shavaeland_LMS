<?php

use Illuminate\Database\Seeder;

class VendorSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Bono Logistics', 'vendor_type' => 'Supplier', 'street_address' => '2 Dann Road', 'city' => 'Kempton Park', 'province' => 'Gauteng', 'postal_code' => null, 'country' => 'South Africa', 'vat' => '6634720504', 'website' => 'www.bonologistics.com', 'email' => null, 'phone_number_1' => '+27 11 892 0297', 'phone_number_2' => null, 'fax_number' => null, 'tax_clearance_number' => null, 'tax_clearance_expiration_date' => '2019-04-10', 'company_registration_number' => null, 'directors_name' => null, 'director_id_number' => null,],
            ['id' => 2, 'name' => 'HR - Shavaeland', 'vendor_type' => 'Department', 'street_address' => '52 Lovemore Street', 'city' => 'Boksburg', 'province' => 'Gauteng', 'postal_code' => '1459', 'country' => 'South Africa', 'vat' => '4050274366', 'website' => 'www.shavaeland.co.za', 'email' => 'hr@shavaeland.co.za', 'phone_number_1' => '+27 11 028 8791', 'phone_number_2' => '+27 73 872 7009', 'fax_number' => null, 'tax_clearance_number' => null, 'tax_clearance_expiration_date' => '2019-04-10', 'company_registration_number' => null, 'directors_name' => null, 'director_id_number' => null,],

        ];

        foreach ($items as $item) {
            \App\Vendor::create($item);
        }
    }
}
