<?php

use Illuminate\Database\Seeder;

class RouteSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'route' => 'Johanneburg - Harare', 'distance' => 1123.5,],
            ['id' => 2, 'route' => 'Johanneburg - Bulawayo', 'distance' => 863,],
            ['id' => 3, 'route' => 'Johanneburg - Zvishavane', 'distance' => 818.22,],
            ['id' => 4, 'route' => 'Johanneburg - Lusaka', 'distance' => 1577.4,],
            ['id' => 5, 'route' => 'Johanneburg - Ndola', 'distance' => 1887.3,],
            ['id' => 6, 'route' => 'Johanneburg - Maputo', 'distance' => 544.5,],
            ['id' => 7, 'route' => 'Johanneburg - Beira', 'distance' => 1343.1,],
            ['id' => 8, 'route' => 'Johanneburg - Durban', 'distance' => 567.6,],
            ['id' => 9, 'route' => 'Harare - Johannesburg', 'distance' => 1123.5,],
            ['id' => 10, 'route' => 'Harare - Bulawayo', 'distance' => 434.8,],
            ['id' => 11, 'route' => 'Harare - Zvishavane', 'distance' => 386.3,],
            ['id' => 12, 'route' => 'Harare - Lusaka', 'distance' => 495.2,],
            ['id' => 13, 'route' => 'Harare - Ndola', 'distance' => 805.1,],
            ['id' => 14, 'route' => 'Harare - Maputo', 'distance' => 1137.2,],
            ['id' => 15, 'route' => 'Harare - Beira', 'distance' => 575.9,],
            ['id' => 16, 'route' => 'Harare - Durban', 'distance' => 1679.6,],
            ['id' => 17, 'route' => 'Bulawayo - Johannesburg', 'distance' => 863,],
            ['id' => 18, 'route' => 'Bulawayo - Harare', 'distance' => 434.8,],
            ['id' => 19, 'route' => 'Bulawayo - Zvishavane', 'distance' => 182.5,],
            ['id' => 20, 'route' => 'Bulawayo - Lusaka', 'distance' => 795,],
            ['id' => 21, 'route' => 'Bulawayo - Ndola', 'distance' => 1104.8,],
            ['id' => 22, 'route' => 'Bulawayo - Maputo', 'distance' => 1021.3,],
            ['id' => 23, 'route' => 'Bulawayo - Beira', 'distance' => 869.5,],
            ['id' => 24, 'route' => 'Bulawayo - Durban', 'distance' => 1417.7,],
            ['id' => 25, 'route' => 'Zvishavane - Johannesburg', 'distance' => 818.22,],
            ['id' => 26, 'route' => 'Zvishavane - Harare', 'distance' => 386.3,],
            ['id' => 27, 'route' => 'Zvishavane - Bulawayo', 'distance' => 182.5,],
            ['id' => 28, 'route' => 'Zvishavane - Lusaka', 'distance' => 755.6,],
            ['id' => 29, 'route' => 'Zvishavane - Ndola', 'distance' => 1065.5,],
            ['id' => 30, 'route' => 'Zvishavane - Maputo', 'distance' => 882.3,],
            ['id' => 31, 'route' => 'Zvishavane - Beira', 'distance' => 687.5,],
            ['id' => 32, 'route' => 'Zvishavane - Durban', 'distance' => 1381.1,],
            ['id' => 33, 'route' => 'Lusaka - Johannesburg', 'distance' => 1577.4,],
            ['id' => 34, 'route' => 'Lusaka - Harare', 'distance' => 495.2,],
            ['id' => 35, 'route' => 'Lusaka - Bulawayo', 'distance' => 795,],
            ['id' => 36, 'route' => 'Lusaka - Zvishavane', 'distance' => 755.6,],
            ['id' => 37, 'route' => 'Lusaka - Ndola', 'distance' => 316.9,],
            ['id' => 38, 'route' => 'Lusaka - Maputo', 'distance' => 1584.2,],
            ['id' => 39, 'route' => 'Lusaka - Beira', 'distance' => 1071.2,],
            ['id' => 40, 'route' => 'Lusaka - Durban', 'distance' => 2133.2,],
            ['id' => 41, 'route' => 'Ndola - Johannesburg', 'distance' => 1887.3,],
            ['id' => 42, 'route' => 'Ndola - Harare', 'distance' => 805.1,],
            ['id' => 43, 'route' => 'Ndola - Bulawayo', 'distance' => 1104.8,],
            ['id' => 44, 'route' => 'Ndola - Zvishavane', 'distance' => 1065.5,],
            ['id' => 45, 'route' => 'Ndola - Lusaka', 'distance' => 316.9,],
            ['id' => 46, 'route' => 'Ndola - Maputo', 'distance' => 1892.7,],
            ['id' => 47, 'route' => 'Ndola - Beira', 'distance' => 1379.7,],
            ['id' => 48, 'route' => 'Ndola - Durban', 'distance' => 2442,],
            ['id' => 49, 'route' => 'Maputo - Johannesburg', 'distance' => 544.5,],
            ['id' => 50, 'route' => 'Maputo - Harare', 'distance' => 1137.2,],
            ['id' => 51, 'route' => 'Maputo - Bulawayo', 'distance' => 1021.3,],
            ['id' => 52, 'route' => 'Maputo - Zvishavane', 'distance' => 882.3,],
            ['id' => 53, 'route' => 'Maputo - Lusaka', 'distance' => 1584.2,],
            ['id' => 54, 'route' => 'Maputo - Ndola', 'distance' => 1892.7,],
            ['id' => 55, 'route' => 'Maputo - Beira', 'distance' => 1067.5,],
            ['id' => 56, 'route' => 'Maputo - Durban', 'distance' => 599.6,],
            ['id' => 57, 'route' => 'Beira - Johannesburg', 'distance' => 1343.1,],
            ['id' => 58, 'route' => 'Beira - Harare', 'distance' => 575.9,],
            ['id' => 59, 'route' => 'Beira - Bulawayo', 'distance' => 869.5,],
            ['id' => 60, 'route' => 'Beira - Zvishavane', 'distance' => 687.5,],
            ['id' => 61, 'route' => 'Beira - Lusaka', 'distance' => 1071.2,],
            ['id' => 62, 'route' => 'Beira - Ndola', 'distance' => 1379.7,],
            ['id' => 63, 'route' => 'Beira - Maputo', 'distance' => 1067.5,],
            ['id' => 64, 'route' => 'Beira - Durban', 'distance' => 1645.8,],
            ['id' => 65, 'route' => 'Durban - Johannesburg', 'distance' => 567.6,],
            ['id' => 66, 'route' => 'Durban - Harare', 'distance' => 1679.6,],
            ['id' => 67, 'route' => 'Durban - Bulawayo', 'distance' => 1417.7,],
            ['id' => 68, 'route' => 'Durban - Zvishavane', 'distance' => 1381.1,],
            ['id' => 69, 'route' => 'Durban - Lusaka', 'distance' => 2133.2,],
            ['id' => 70, 'route' => 'Durban - Ndola', 'distance' => 2442,],
            ['id' => 71, 'route' => 'Durban - Maputo', 'distance' => 599.6,],
            ['id' => 72, 'route' => 'Durban - Beira', 'distance' => 1645.8,],
            ['id' => 73, 'route' => 'Johannesburg - Seshego', 'distance' => 325.1,],
            ['id' => 74, 'route' => 'Seshego - Johannesburg', 'distance' => 325.1,],

        ];

        foreach ($items as $item) {
            \App\Route::create($item);
        }
    }
}
