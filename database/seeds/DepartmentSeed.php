<?php

use Illuminate\Database\Seeder;

class DepartmentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'dept_name' => 'Human Resources', 'manager' => 'Tafadzwa Nyagumbo', 'street_address' => '52 Lovemore Street', 'city' => 'Boksburg', 'province' => 'Gauteng', 'country' => 'South Africa', 'phone_no' => '+27 11 028 8791', 'extension' => null, 'mobile_number' => null, 'email' => 'hr@shavaeland.co.za',],
            ['id' => 2, 'dept_name' => 'Operations', 'manager' => 'Desmond Nyagumbo', 'street_address' => '52 Lovemore Street', 'city' => 'Boksburg', 'province' => 'Gauteng', 'country' => 'South Africa', 'phone_no' => '+27 11 028 8791', 'extension' => null, 'mobile_number' => null, 'email' => 'operations@shavaeland.co.za',],
            ['id' => 3, 'dept_name' => 'Accounts', 'manager' => 'Desmond Nyagumbo', 'street_address' => '52 Lovemore Street', 'city' => 'Boksburg', 'province' => 'Gauteng', 'country' => 'South Africa', 'phone_no' => '+27 11 028 8791', 'extension' => null, 'mobile_number' => null, 'email' => 'accounts@shavaeland.co.za',],
            ['id' => 4, 'dept_name' => 'Workshop', 'manager' => 'Hillary Mubanga', 'street_address' => '52 Lovemore Street', 'city' => 'Boksburg', 'province' => 'Gauteng', 'country' => 'South Africa', 'phone_no' => '+27 11 028 8791', 'extension' => null, 'mobile_number' => null, 'email' => 'workshop@shavaeland.co.za',],

        ];

        foreach ($items as $item) {
            \App\Department::create($item);
        }
    }
}
