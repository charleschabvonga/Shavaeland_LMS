<?php

use Illuminate\Database\Seeder;

class VehicleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'vehicle_description' => 'FH00GSGP', 'make' => 'SCANIA', 'model' => 'R480', 'purchase_date' => '', 'purchase_price' => null, 'chasis_number' => '9BSR6X40003594534', 'engine_number' => null, 'size_id' => null, 'starting_mileage' => null, 'next_service_mileage' => null, 'next_service_date' => '', 'service_status' => null, 'availability' => 'Yes', 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 2, 'vehicle_description' => 'FH89ZKGP', 'make' => 'SCANIA', 'model' => 'R420', 'purchase_date' => '', 'purchase_price' => null, 'chasis_number' => '9BSR6X40003593068', 'engine_number' => null, 'size_id' => null, 'starting_mileage' => null, 'next_service_mileage' => null, 'next_service_date' => '', 'service_status' => null, 'availability' => 'Yes', 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 3, 'vehicle_description' => 'TTK571GP', 'make' => 'SCANIA', 'model' => 'R480', 'purchase_date' => '', 'purchase_price' => null, 'chasis_number' => '9BSR6X40003581491', 'engine_number' => null, 'size_id' => null, 'starting_mileage' => null, 'next_service_mileage' => null, 'next_service_date' => '', 'service_status' => null, 'availability' => 'Yes', 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 4, 'vehicle_description' => 'VTS949GP', 'make' => 'SCANIA', 'model' => 'R480', 'purchase_date' => '', 'purchase_price' => null, 'chasis_number' => '9BSR6X40003596681', 'engine_number' => null, 'size_id' => null, 'starting_mileage' => null, 'next_service_mileage' => null, 'next_service_date' => '', 'service_status' => null, 'availability' => 'Yes', 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 5, 'vehicle_description' => 'ACE0482', 'make' => 'DAF', 'model' => 'XF95', 'purchase_date' => '', 'purchase_price' => null, 'chasis_number' => 'XLRTG47XSOE590187', 'engine_number' => null, 'size_id' => null, 'starting_mileage' => null, 'next_service_mileage' => null, 'next_service_date' => '', 'service_status' => null, 'availability' => 'Yes', 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 6, 'vehicle_description' => 'ABZ6465', 'make' => 'DAF', 'model' => 'XF95', 'purchase_date' => '', 'purchase_price' => null, 'chasis_number' => 'XLRTG47XSOE583447', 'engine_number' => null, 'size_id' => null, 'starting_mileage' => null, 'next_service_mileage' => null, 'next_service_date' => '', 'service_status' => 'Scheduled', 'availability' => 'Yes', 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],

        ];

        foreach ($items as $item) {
            \App\Vehicle::create($item);
        }
    }
}
