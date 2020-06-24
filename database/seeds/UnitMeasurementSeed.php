<?php

use Illuminate\Database\Seeder;

class UnitMeasurementSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'measurement_type' => '',],
            ['id' => 2, 'measurement_type' => 'km(s)',],
            ['id' => 3, 'measurement_type' => 'kg(s)',],
            ['id' => 4, 'measurement_type' => 'ton(s)',],
            ['id' => 5, 'measurement_type' => 'm^2(s)',],
            ['id' => 6, 'measurement_type' => 'ltr(s)',],
            ['id' => 7, 'measurement_type' => 'hr(s)',],
            ['id' => 8, 'measurement_type' => 'trip(s)',],

        ];

        foreach ($items as $item) {
            \App\UnitMeasurement::create($item);
        }
    }
}
