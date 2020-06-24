<?php

use Illuminate\Database\Seeder;

class CurrencySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Rand', 'symbol' => 'R',],
            ['id' => 2, 'name' => 'USD', 'symbol' => '$',],

        ];

        foreach ($items as $item) {
            \App\Currency::create($item);
        }
    }
}
