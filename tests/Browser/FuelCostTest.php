<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class FuelCostTest extends DuskTestCase
{

    public function testCreateFuelCost()
    {
        $admin = \App\User::find(1);
        $fuel_cost = factory('App\FuelCost')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $fuel_cost) {
            $browser->loginAs($admin)
                ->visit(route('admin.fuel_costs.index'))
                ->clickLink('Add new')
                ->type("receipt_number", $fuel_cost->receipt_number)
                ->select("road_freight_number_id", $fuel_cost->road_freight_number_id)
                ->select("vehicle_id", $fuel_cost->vehicle_id)
                ->type("description", $fuel_cost->description)
                ->type("qty", $fuel_cost->qty)
                ->type("cost", $fuel_cost->cost)
                ->type("unit", $fuel_cost->unit)
                ->type("total", $fuel_cost->total)
                ->select("currency_id", $fuel_cost->currency_id)
                ->press('Save')
                ->assertRouteIs('admin.fuel_costs.index')
                ->assertSeeIn("tr:last-child td[field-key='receipt_number']", $fuel_cost->receipt_number)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $fuel_cost->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $fuel_cost->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='description']", $fuel_cost->description)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $fuel_cost->qty)
                ->assertSeeIn("tr:last-child td[field-key='cost']", $fuel_cost->cost)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $fuel_cost->unit)
                ->assertSeeIn("tr:last-child td[field-key='total']", $fuel_cost->total)
                ->assertSeeIn("tr:last-child td[field-key='currency']", $fuel_cost->currency->name)
                ->logout();
        });
    }

    public function testEditFuelCost()
    {
        $admin = \App\User::find(1);
        $fuel_cost = factory('App\FuelCost')->create();
        $fuel_cost2 = factory('App\FuelCost')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $fuel_cost, $fuel_cost2) {
            $browser->loginAs($admin)
                ->visit(route('admin.fuel_costs.index'))
                ->click('tr[data-entry-id="' . $fuel_cost->id . '"] .btn-info')
                ->type("receipt_number", $fuel_cost2->receipt_number)
                ->select("road_freight_number_id", $fuel_cost2->road_freight_number_id)
                ->select("vehicle_id", $fuel_cost2->vehicle_id)
                ->type("description", $fuel_cost2->description)
                ->type("qty", $fuel_cost2->qty)
                ->type("cost", $fuel_cost2->cost)
                ->type("unit", $fuel_cost2->unit)
                ->type("total", $fuel_cost2->total)
                ->select("currency_id", $fuel_cost2->currency_id)
                ->press('Update')
                ->assertRouteIs('admin.fuel_costs.index')
                ->assertSeeIn("tr:last-child td[field-key='receipt_number']", $fuel_cost2->receipt_number)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $fuel_cost2->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $fuel_cost2->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='description']", $fuel_cost2->description)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $fuel_cost2->qty)
                ->assertSeeIn("tr:last-child td[field-key='cost']", $fuel_cost2->cost)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $fuel_cost2->unit)
                ->assertSeeIn("tr:last-child td[field-key='total']", $fuel_cost2->total)
                ->assertSeeIn("tr:last-child td[field-key='currency']", $fuel_cost2->currency->name)
                ->logout();
        });
    }

    public function testShowFuelCost()
    {
        $admin = \App\User::find(1);
        $fuel_cost = factory('App\FuelCost')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $fuel_cost) {
            $browser->loginAs($admin)
                ->visit(route('admin.fuel_costs.index'))
                ->click('tr[data-entry-id="' . $fuel_cost->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='receipt_number']", $fuel_cost->receipt_number)
                ->assertSeeIn("td[field-key='road_freight_number']", $fuel_cost->road_freight_number->road_freight_number)
                ->assertSeeIn("td[field-key='vehicle']", $fuel_cost->vehicle->vehicle_description)
                ->assertSeeIn("td[field-key='description']", $fuel_cost->description)
                ->assertSeeIn("td[field-key='qty']", $fuel_cost->qty)
                ->assertSeeIn("td[field-key='cost']", $fuel_cost->cost)
                ->assertSeeIn("td[field-key='unit']", $fuel_cost->unit)
                ->assertSeeIn("td[field-key='total']", $fuel_cost->total)
                ->assertSeeIn("td[field-key='currency']", $fuel_cost->currency->name)
                ->logout();
        });
    }

}
