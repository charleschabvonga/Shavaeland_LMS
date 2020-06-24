<?php

use Illuminate\Database\Seeder;

class TrailerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 11, 'trailer_type_id' => 4, 'trailer_description' => 'JWG232GP', 'make' => null, 'model' => 'BPW61', 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => 'LM15734', 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 12, 'trailer_type_id' => 5, 'trailer_description' => 'JWG227GP', 'make' => null, 'model' => 'BPW122', 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => 'LM15785', 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 13, 'trailer_type_id' => 4, 'trailer_description' => 'CJ92VCGP', 'make' => 'Hendred', 'model' => 'PHFJ26ZX', 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => 'AAH088629', 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 14, 'trailer_type_id' => 5, 'trailer_description' => 'CJ92TNGP', 'make' => 'Hendred', 'model' => 'PHRF2122', 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => 'AAH088582', 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 15, 'trailer_type_id' => 4, 'trailer_description' => 'ZKX348GP', 'make' => 'Tandem', 'model' => null, 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => 'CAT9608130163', 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 16, 'trailer_type_id' => 5, 'trailer_description' => 'HKT081GP', 'make' => 'Tandem', 'model' => null, 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => 'AAOA338M36LAC1160', 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 17, 'trailer_type_id' => 4, 'trailer_description' => 'HWS433NW', 'make' => null, 'model' => null, 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => null, 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 18, 'trailer_type_id' => 5, 'trailer_description' => 'BR34DRGP', 'make' => 'SV', 'model' => null, 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => 'H 188 03', 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 19, 'trailer_type_id' => 3, 'trailer_description' => 'ADZ7898', 'make' => 'Crane', 'model' => null, 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => 'SW803438', 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 20, 'trailer_type_id' => 3, 'trailer_description' => 'ABN8236', 'make' => null, 'model' => null, 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => 'SMRC3A04498M16373', 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 21, 'trailer_type_id' => 4, 'trailer_description' => 'FH89LKGP', 'make' => null, 'model' => 'HPC trailers', 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => 'AA9B225MBCWLX2412', 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],
            ['id' => 22, 'trailer_type_id' => 5, 'trailer_description' => 'FL55DFGP', 'make' => null, 'model' => null, 'availability' => 'Yes', 'service_status' => 'Scheduled', 'chasis_number' => null, 'purchase_date' => '', 'purchase_price' => null, 'salvage_value' => null, 'investment' => null, 'depreciation' => null, 'maintenance' => null, 'tyre' => null,],

        ];

        foreach ($items as $item) {
            \App\Trailer::create($item);
        }
    }
}
