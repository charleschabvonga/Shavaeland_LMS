<?php

use Illuminate\Database\Seeder;

class EmployeeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Desmond Nyagumbo', 'position' => 'Director', 'start_date' => '2018-01-01', 'end_date' => '', 'status' => 'Full-time', 'street_address' => '52 Lovemore Street', 'city' => 'Boksburg', 'province' => 'Gauteng', 'country' => 'South Africa', 'sa_mobile' => '+27 73 872 7009', 'int_mobile' => '+263 77 731 7449', 'email' => 'desmond@shavaeland.co.za',],
            ['id' => 2, 'name' => 'Tafadzwa Nyagumbo', 'position' => 'Administrator', 'start_date' => '2019-01-01', 'end_date' => '', 'status' => 'Full-time', 'street_address' => '229 Green Park Apt', 'city' => 'Boksburg', 'province' => 'Gauteng', 'country' => 'South Africa', 'sa_mobile' => '+27 84 270  6635', 'int_mobile' => null, 'email' => 'tafadzwa@shavaeland.co.za',],
            ['id' => 3, 'name' => 'Hillary Mubanga', 'position' => 'Manager', 'start_date' => '2019-01-01', 'end_date' => '', 'status' => 'Full-time', 'street_address' => null, 'city' => null, 'province' => null, 'country' => null, 'sa_mobile' => '+27 83 329 9632', 'int_mobile' => '+263 71 610 1481', 'email' => 'hillary@shavaeland.co.za',],
            ['id' => 4, 'name' => 'Felix Msemwa', 'position' => 'Driver', 'start_date' => '2019-01-01', 'end_date' => '', 'status' => 'Full-time', 'street_address' => null, 'city' => null, 'province' => null, 'country' => null, 'sa_mobile' => null, 'int_mobile' => null, 'email' => null,],
            ['id' => 5, 'name' => 'Tapiwa Musanhu', 'position' => 'Driver', 'start_date' => '2019-01-01', 'end_date' => '', 'status' => 'Full-time', 'street_address' => '1164 Zengeza 1Chitungwiza', 'city' => 'Harare', 'province' => 'Harare Metropolitan', 'country' => 'Zimbabwe', 'sa_mobile' => '+27 61 080 3812', 'int_mobile' => '+263 782480604', 'email' => null,],
            ['id' => 9, 'name' => 'Desmond Malaulo', 'position' => 'Driver', 'start_date' => '2019-04-01', 'end_date' => '', 'status' => 'Full-time', 'street_address' => '64 Nyandoro Street PO Rimuka', 'city' => 'Kadoma', 'province' => 'Mashonaland West', 'country' => 'Zimbabwe', 'sa_mobile' => '+27 74 623 6121', 'int_mobile' => '+263772577995', 'email' => 'ronaldmalaulo@gmail.com',],

        ];

        foreach ($items as $item) {
            \App\Employee::create($item);
        }
    }
}
